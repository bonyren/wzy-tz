<?php
// +----------------------------------------------------------------------
// | WZYCODING [ SIMPLE SOFTWARE IS THE BEST ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018~2025 wzycoding All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://license.coscl.org.cn/MulanPSL2 )
// +----------------------------------------------------------------------
// | Author: wzycoding <wzycoding@qq.com>
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\index\logic\Contact;
use app\index\logic\Defs;
use app\index\logic\Enterprise;
use app\index\logic\Extra;
use app\index\logic\Meeting;
use app\index\logic\SubIndustryLogic;
use app\index\logic\Upload;
use app\index\logic\UsersFollow;
use app\index\model\Attachments;
use app\index\model\Dropdowns;
use app\index\model\Edividends;
use app\index\model\EFounders;
use app\index\model\FundsEnterprises;
use app\index\model\FundsFinanceIncomes;
use think\Db;
use think\Log;
use app\index\service\Credit as CreditService;
use app\index\logic\Admins as AdminsLogic;
use app\index\model\Contacts as ContactsModel;

class Enterprises extends Common
{
    protected $_model_name = 'enterprises';
    protected $step2tab = [
        1 => 0,
        2 => 1,
        3 => 1,
        4 => 2,
        5 => 3,
        6 => 4,
    ];

    public function _initialize(){
        parent::_initialize();
        $this->assign('_model_name',$this->_model_name);
    }

    public function getIndustriesTree(){
        $industries = Enterprise::I()->treeIndustries();
        return json(array_values($industries));
    }
    /**
     *通过第三方系统查询公司
     */
    public function creditSearch($search=[]){
        if($this->request->isGet()){
            return $this->fetch();
        }
        if(emptyInArray($search, 'kw')){
            return json([]);
        }
        $kw = $search['kw'];
        try{
            $records = CreditService::I()->search($kw);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return ajaxDatagridDataError($e->getMessage());
        }
        return json($records);
    }
    //通过外网搜索添加项目
    public function external($source) {
        $kw = input('request.kw');
        $this->assign('search_url',url('enterprises/external',['source'=>$source]));
        return $this->$source($kw);
    }

    public function qcc($kw='') {
        if ($this->request->isPost() && !empty($kw)) {
            try {
                $http = new \GuzzleHttp\Client();
                $response = $http->get('https://www.qichacha.com/search', [
                    'query' => ['key' => $kw],
                    'curl'  =>  [
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1
                    ],
                    'headers' => [
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36',
                        'Cookie' => 'UM_distinctid=16c1e20fa52172-0ecd041b33d573-9333061-1fa400-16c1e20fa532a4; zg_did=%7B%22did%22%3A%20%2216c1e21248948-009481d4a71992-9333061-1fa400-16c1e21248a44d%22%7D; _uab_collina=156387358522156745350331; QCCSESSID=qma1faj6ukn1br1u7tl408cbj3; Hm_lvt_3456bee468c83cc63fb5147f119f1075=1573438423; acw_tc=7909f41715734384222817179e75b4e351dbdb30e261584898a535e65e; CNZZDATA1254842228=385358467-1563869744-https%253A%252F%252Fwww.baidu.com%252F%7C1573719857; hasShow=1; zg_de1d1a35bfa24ce29bbf2c7eb17e6c4f=%7B%22sid%22%3A%201573724894516%2C%22updated%22%3A%201573724961953%2C%22info%22%3A%201573438422979%2C%22superProperty%22%3A%20%22%7B%7D%22%2C%22platform%22%3A%20%22%7B%7D%22%2C%22utm%22%3A%20%22%7B%7D%22%2C%22referrerDomain%22%3A%20%22%22%2C%22cuid%22%3A%20%226b5bd244d8244be2761dadc6705cac33%22%2C%22zs%22%3A%200%2C%22sc%22%3A%200%7D; Hm_lpvt_3456bee468c83cc63fb5147f119f1075=1573724962',
                        'Host' => 'www.qichacha.com',
                        'Referer' => 'https://www.qichacha.com/'
                    ]
                ]);
                $html = $response->getBody()->getContents();
                Log::write("qcc return content: " . $html, Log::NOTICE);
                $regex = '|<table class="ntable ntable-list" data-v-.*>.*</table>|Uis';
                preg_match_all($regex, $html, $matches);
                $this->assign('companies', $matches[0][0]);
            } catch (\Exception $e) {
                $this->assign('error',$e->getMessage());
            }
            $this->assign(['search'=>true,'kw'=>$kw]);
        }
        return $this->fetch(__FUNCTION__);
    }

    public function index($search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$step=0,$step_state='')
    {
        $step = intval($step);
        if($this->request->isGet()){
            $urls = [
                'edit'=>url('index/Enterprises/edit'),
                'delete'=>url('index/Enterprises/delete'),
                'view'=>url('index/Enterprises/view'),
                'gostep'=>url('index/Enterprises/gostep'),
                'initiate_meeting'=>url('index/Enterprises/initiateMeeting'),
            ];
            $this->assign('urls', $urls);
            $this->assign('step', $step);
            return $this->fetch();
        }
        if ($step) {
            $search['step'] = $step;
        }
        if ($step_state) {
            $search['step_state'] = $step_state;
        }
        $data = Enterprise::I()->load($search,$page,$rows);
        if (empty($data)){
            return '[]';
        }
        $assigners = '';
        $founders = [];
        $follows = UsersFollow::I()->getMyFollows(UsersFollow::TYPE_PROJECT, $this->loginUserId);
        foreach ($data['rows'] as $k=>$v) {
            $assigners .= (empty($assigners) ? '' : ',') . $v['assigner'];
            if ($v['founder']) {
                $founders[$v['founder']] = $v['founder'];
            }
            $uids = explode(',',$v['assigner'] . ',' . $v['additional_assigners']);
            $data['rows'][$k]['editable'] = $this->loginSuperUser || in_array($this->loginUserId, $uids);
            $data['rows'][$k]['is_follow'] = isset($follows[$v['id']]) ? 1 : 0;
        }
        //创始人
        if (empty($founders)) {
            $data['founders'] = [];
        } else {
            $data['founders'] = ContactsModel::where('id', 'in', $founders)->column('id,name,title', 'id');
        }
        if (empty($assigners)) {
            $data['assigners'] = [];
        } else {
            $data['assigners'] = AdminsLogic::I()->getAdminsByIds($assigners);
        }
        return json($data);
    }

    /**
     * 添加/编辑企业
     * @param int $id
     * @return mixed
     */
    public function edit($id=0)
    {
        $enterprise = $id ? Enterprise::I()->getEnterprise($id) : ['step'=>1];

        if ($this->request->isGet()) {
            $this->assign([
                'readonly'=> 0,
                'enterprise' => $enterprise,
                'external'=> array_merge(['name'=>'', 'boss'=>'', 'address'=>'', 'phone'=>''], input('get.')),
                'users' => AdminsLogic::I()->getAllUsers(),
                'default_tab' => $this->step2tab[$enterprise['step']],
            ]);
            return $this->fetch(empty($id) ? 'add' : 'edit');
        }

        $data = input('post.');
        try {
            $founder = $data['founder'];
            if ($founder) {
                $founder['assigner'] = $data['enterprise']['assigner'];
                $founder['additional_assigners'] = $data['enterprise']['additional_assigners'];
                if (empty($id)) {
                    //新增
                    $founder['title'] = '创始人';
                    $founder_id = Contact::I()->saveContact(0,$founder);
                    $data['enterprise']['founder'] = $founder_id;
                }else{
                    //修改
                    Contact::I()->saveContact($enterprise['founder'],$founder);
                }
            }
            $id = Enterprise::I()->saveEnterprise($id, $data['enterprise']);
            if (isset($founder_id)) {
                Enterprise::I()->setEnterpriseFounders($id,$founder_id);
            }
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }

        if (!empty($data['pending_files'])) {
            Upload::I()->relateAttaches($data['pending_files'],$id);
        }

        if ($data['extra']) {
            Extra::I()->setValue('Enterprises',$id,$data['extra']);
            if ($data['extra']['sub_industry']) {
                SubIndustryLogic::I()->replaceEnterpriseSubIndustry($id,$enterprise['extra']['sub_industry'],$data['extra']['sub_industry']);
            }
        }

        return ajaxSuccess('保存成功');
    }

    //基本信息
    public function baseInfo($enterprise_id,$readonly=1)
    {
        $enterprise = Enterprise::I()->getEnterprise($enterprise_id);
        if (empty($enterprise)) {
            return $this->fetch('common/missing');
        }
        $enterprise['founder'] = Contact::I()->getContact($enterprise['founder']);
        $this->assign([
            'users' => AdminsLogic::I()->getAllUsers(),
            'enterprise' => $enterprise,
            'readonly' => intval($readonly),
        ]);
        return $this->fetch($readonly?'base_info_view':'base_info');
    }

    //公司情况
    public function companyInfo($enterprise_id,$readonly=1)
    {
        $enterprise = Enterprise::I()->getEnterprise($enterprise_id);
        $this->assign('enterprise', $enterprise);
        $this->assign('readonly', intval($readonly));
        $this->assign('hidden', $readonly?'hidden':'');
        return $this->fetch();
    }

    /**
     * 查看企业详情
     * @param $id
     * @return mixed
     */
    public function view($id){
        $enterprise = Enterprise::I()->getEnterprise($id);
        if (empty($enterprise)) {
            return $this->fetch('common/missing');
        }
        $founder = Contact::I()->getContact($enterprise['founder']);
        $this->assign('row', $enterprise);
        $this->assign('founder', $founder ?: []);
        $this->assign('default_tab',$this->step2tab[$enterprise['step']]);
        return $this->fetch();
    }

    //更新进度
    public function gostep($id, $type){
        try {
            Enterprise::I()->goStep($id,$type);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('操作成功');
    }

    /**
     * 删除
     * @param $id
     * @return \think\response\Json
     */
    public function delete($id){
        try {
            Enterprise::I()->delete($id);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('删除成功');
    }


    /**
     * 发起会议
     * @param $enterprise_id
     * @param $meeting_type
     * @param $meeting_id
     * @return mixed
     */
    public function initiateMeeting($meeting_type, $enterprise_id, $meeting_id=0)
    {
        $get = input('get.');
        if($this->request->isPost()){
            if (empty($meeting_id)) {
                //新增
                $data = input('post.data/a');
                $data['type'] = $meeting_type;
                $data['enterprise_id'] = $enterprise_id;
                $data['investment_id'] = intval($get['investment_id']);
                try {
                    $meeting_id = Meeting::I()->setProjectMeeting($data);
                } catch (\Exception $e) {
                    return ajaxError($e->getMessage());
                }
                if(!empty($_POST['pending_files'])) {
                    Upload::I()->relateAttaches($_POST['pending_files'], $enterprise_id, $meeting_id);
                }
            }else{
                //修改
                $data = input('post.data/a');
                $data['type'] = $meeting_type;
                $data['enterprise_id'] = $enterprise_id;
                $data['investment_id'] = intval($get['investment_id']);
                try {
                    $meeting_id = Meeting::I()->updateProjectMeeting($meeting_id, $data);
                } catch (\Exception $e) {
                    return ajaxError($e->getMessage());
                }
            }
            return ajaxSuccess('保存成功');
        }
        $enterprise = Enterprise::I()->getEnterprise($enterprise_id);
        if(empty($get['investment_id']) && $enterprise['step_state']>0){
            //已发起会议
            $meeting = Meeting::I()->getRelatedMeeting($meeting_type,$enterprise_id);
        } else {
            $meeting = [];
        }
        if (empty($meeting)) {
            //新会议
            $type_info = Meeting::getTypes($meeting_type);
            $meeting_title = ($enterprise['alias'] ?: $enterprise['name']) . '-' .$type_info['label'];
            if ($get['investment_id']) {
                $stage = Db::table('investment')->where(['id'=>$get['investment_id']])->value('financing_stage');
                $stage = Dropdowns::getLabel('financing_stage',$stage);
                $meeting_title .= "（{$stage}）";
            } else {
                $meeting_title .= '（'.date('Ymd').'）';
            }
        } else {
            $meeting_title = $meeting['title'];
        }
        $this->assign('bind',[
            'enterprise' => $enterprise,
            'meeting' => $meeting,
            'enterprise_id' => $enterprise_id,
            'meeting_type' => $meeting_type,
            'title' => $meeting_title,
        ]);
        $this->assign('principle',$enterprise['extra']['principle']);
        return $this->fetch();
    }

    //会议完成通知回调
    public function completeMeeting($meeting_id)
    {
        $meeting = Meeting::I()->getMeeting($meeting_id);
        if ($meeting['investment_id']) {
            if ($meeting['status'] == Meeting::STATUS_ENDED_REJECT) {
                //不通过
                $status = -1;
            } else {
                $status = 1;
            }
            Db::table('investment')->where(['id'=>$meeting['investment_id']])->setField('status',$status);
            return;
        }
        $enterprise = Enterprise::I()->getEnterprise($meeting['relate_id']);
        $update = [];
        if ($meeting['status'] == Meeting::STATUS_ENDED_REJECT) { //未通过
            $update['step_state'] = '-1';
            $update['istop'] = '-1'; //下沉该项目
        } else {
            switch ($meeting['type']) {
                case Enterprise::STEP_LEARN: //立项会
                    if ($enterprise['step'] == Enterprise::STEP_LEARN) {
                        //尽调
                        $update['step'] = Enterprise::STEP_DD;
                        $update['step_state'] = 0;
                    }
                    break;
                case Enterprise::STEP_DD: //投决会
                    if ($enterprise['step'] == Enterprise::STEP_DD) {
                        //投资中
                        $update['step'] = Enterprise::STEP_INVESTING;
                        $update['step_state'] = 0;
                    }
                    break;
            }
        }
        model('Enterprises')->save($update, ['id'=>$meeting['relate_id']]);
    }


    //--------------------------------------------投资交割--------------------------------------------------------------
    //投资交割

    //批量设置投资基金
    public function investFundsSet($enterprise_id,$investment_id,$funds_id)
    {
        if($this->request->isGet()){
            if (!is_array($funds_id)) {
                $funds_id = explode(',', $funds_id);
            }
            $where['fund_id'] = isset($funds_id[1]) ? ['in',$funds_id] : $funds_id[0];
            $funds = db('funds')->where($where)
                ->field('fund_id,name,size')->order('fund_id asc')->select();
            if (empty($funds)) {
                $funds = [];
            }
            return $this->fetch('',[
                'enterprise_id' => $enterprise_id,
                'enterprise' => Enterprise::I()->getEnterprise($enterprise_id),
                'funds' => $funds,
            ]);
        }
        try {
            $post = input('post.');
            Enterprise::I()->addInvestFunds($enterprise_id,$investment_id,$post['funds']);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('设置成功');
    }

    //编辑单个投资基金
    public function investFundEdit($id){
        $mode = new FundsEnterprises();
        if($this->request->isGet()){
            $data = $mode::get($id)->toArray();
            $data['fund'] = \app\index\model\Funds::get($data['fund_id']);
            $element_id = 'ffe_edit_'.$data['ffe_id'];
            return $this->fetch('',[
                'data' => $data,
                'element_id' => $element_id,
                'uuid' => md5("#{$element_id}"),
            ]);
        }
        try {
            $mode::update($_POST['data'],['id'=>$id],true);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess();
    }

    //删除单个投资基金
    public function investFundRemove($id){
        try {
            FundsEnterprises::destroy($id);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('删除成功');
    }

    //------------------------------------------投融资管理--------------------------------------------------------------
    //tab导航
    public function investmentAndFinancing($enterprise_id,$readonly=null){
        return $this->fetch('',['enterprise_id'=>$enterprise_id,'readonly'=>$readonly]);
    }

    //投融资管理
    public function financeRecords($enterprise_id,$page=1,$rows=DEFAULT_PAGE_ROWS,$readonly=0)
    {
        if($this->request->isGet()){
            return $this->fetch('',[
                'enterprise_id'=>$enterprise_id,
                'readonly'=>$readonly,
            ]);
        }
        $where = ['enterprise_id'=>$enterprise_id];
        $count = Db::table('enterprises_financing')->where($where)->count();
        if (empty($count)) {
            return json([]);
        }
        $items = Db::table('enterprises_financing')->where($where)->page($page,$rows)->order('when desc,id desc')->select();
        return json(['total'=>$count, 'rows'=>$items]);
    }

    //添加、编辑融资记录
    public function editFinanceRecord($enterprise_id,$id=0)
    {
        if($this->request->isGet()){
            $info = $id ? Enterprise::I()->getFinancingInfo($id) : [];
            return $this->fetch('',['info'=>$info]);
        }

        $data = input('post.data/a');
        $rows = $_POST['rows'.$data['type']];
        if (empty($rows)) {
            return ajaxError('请设置变更明细');
        }

        if ($id) {
            Db::table('enterprises_financing')->where(['id'=>$id])->update($data);
        } else {
            $data['enterprise_id'] = $enterprise_id;
            $id = Db::table('enterprises_financing')->insertGetId($data);
            if (!empty($_POST['pending_files'])) {
                Upload::I()->relateAttaches($_POST['pending_files'], $id);
            }
        }

        //更新企业最新估值
        $latest_valuation = Db::table('enterprises_financing')
            ->where(['enterprise_id'=>$enterprise_id])->order('when','desc')->value('valuation');
        model('Enterprises')->save(['latest_valuation'=>$latest_valuation], ['id'=>$enterprise_id]);

        //设置明细
        Extra::I()->setValue('enterprises_financing',$id,'detail',array_values($rows));

        if ($_POST['shareholders_excel']) {
            $es['eid'] = $enterprise_id;
            $es['date'] = $data['when'];
            $es['name'] = $data['title'] . ' - 股东表';
            $esid = Enterprise::I()->addShareholders($es, $_POST['shareholders_excel']);
            Db::table('enterprises_financing')->where(['id'=>$id])->setField('esid',$esid);
        }

        //Enterprise::I()->updateFundsStockRatio($enterprise_id);
        return ajaxSuccess('保存成功');
    }

    //删除单条融资记录
    public function delFinanceRecord($id){
        Db::table('enterprises_financing')->where(['id'=>$id])->delete();
        Extra::I()->removeKey('enterprises_financing',$id,'detail');
        //Enterprise::I()->updateFundsStockRatio($row['enterprise_id']);
        return ajaxSuccess('删除成功');
    }

    public function getFinancingDetail($efid) {
        $data = Enterprise::I()->getFinancingInfo($efid);
        return $this->fetch('',['data'=>$data]);
    }

    //---------------------------------------------股东表---------------------------------------------------------------
    //股东表
    public function shareholders($enterprise_id,$page=1,$rows=DEFAULT_PAGE_ROWS,$readonly=0)
    {
        if($this->request->isGet()){
            return $this->fetch('',[
                'enterprise_id'=>$enterprise_id,
                'readonly'=>$readonly,
            ]);
        }
        $where = ['eid'=>$enterprise_id];
        $count = Db::table('enterprise_shareholder')->where($where)->count();
        if (empty($count)) {
            return json([]);
        }
        $items = Db::table('enterprise_shareholder')->where($where)->page($page,$rows)->order('id desc')->select();
        return json([
            'total'=>$count,
            'rows'=>$items
        ]);
    }

    public function getShareholderDetail($esid)
    {
        $rows = Db::table('enterprise_shareholder_detail')->where(['esid'=>$esid])->order('id asc')->select();
        return $this->fetch('',['rows'=>$rows,'readonly'=>!isset($_GET['readonly']) || $_GET['readonly']]);
    }

    //添加、编辑股东表
    public function shareholdersEdit($enterprise_id=0,$id=0,$readonly=0)
    {
        if($this->request->isGet()){
            $info = Db::table('enterprise_shareholder')->where(['id'=>$id])->find();
            return $this->fetch('',['info'=>$info,'readonly'=>$readonly]);
        }
        $data = input('post.data/a');
        $data['id'] = $id;
        $data['eid'] = $enterprise_id;
        try {
            Enterprise::I()->addShareholders($data,$_POST['shareholders_excel']);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        if (!empty($_POST['detail'])) {
            Enterprise::I()->updateShareholderDetail($_POST['detail']);
        }
        return ajaxSuccess('保存成功');
    }

    //删除股东表
    public function shareholdersRemove($id) {
        Enterprise::I()->delShareholders($id);
        return ajaxSuccess('删除成功');
    }

    //--------------------------------------------项目分红--------------------------------------------------------------
    //项目分红
    public function dividends($enterprise_id,$search=[],$page=1,$rows=DEFAULT_PAGE_ROWS,$readonly=0){
        if($this->request->isGet()){
            return $this->fetch('',[
                'enterprise_id'=>$enterprise_id,
                'readonly'=>$readonly,
            ]);
        }
        $where = ['ed.enterprise_id'=>$enterprise_id];
        $count = Db::table('enterprises_dividends')->alias('ed')->where($where)->count();
        $items = Db::table('enterprises_dividends')->alias('ed')
            ->join('funds f','f.fund_id=ed.fund_id')
            ->join('funds_finance_incomes ffi','ffi.ffi_id=ed.ffi_id')
            ->field('ed.id,ed.fund_id,ed.ffi_id,ed.description,f.name as fund_name,ffi.amount,ffi.date')
            ->where($where)->page($page,$rows)->order('ed.id DESC')->select();
        return json(['total'=>$count,'rows'=>$items]);
    }

    //添加、编辑项目分红
    public function editDividends($enterprise_id,$id=0){
        $model = new Edividends();
        if($this->request->isGet()){
            if ($id) {
                $ed = $model::get($id);
                $ed['ffi'] = FundsFinanceIncomes::get($ed['ffi_id']);
            } else {
                $ed = [];
            }
            $funds = Enterprise::I()->getInvestFunds($enterprise_id, $ed['fund_id']);
            return $this->fetch('',[
                'ed'=>$ed,
                'funds'=>$funds,
                'enterprise_id'=>$enterprise_id,
                'enterprise' => Enterprise::I()->getEnterprise($enterprise_id)
            ]);
        }
        try {
            Enterprise::I()->setDividend($enterprise_id,$_POST['allocate']);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }

        return ajaxSuccess('保存成功');
    }

    //删除项目分红
    public function delDividends($id){
        Enterprise::I()->deleteDividend($id);
        return ajaxSuccess('删除成功');
    }

    //--------------------------------------------创始团队--------------------------------------------------------------
    //创始团队
    public function founders($enterprise_id,$readonly=1){
        if($this->request->isGet()){
            return $this->fetch('',[
                'enterprise_id'=>$enterprise_id,
                'readonly'=>$readonly,
                'tag_url'=>url('tags/showTagsBatch',['category'=>4]),
            ]);
        }
        $data = Enterprise::I()->getEnterpriseFounders($enterprise_id);
        return json(array_values($data));
    }
    //删除创始团队成员
    public function founderRemove($id){
        try {
            EFounders::destroy($id);
        } catch (\Exception $e) {
            return ajaxError($e->getMessage());
        }
        return ajaxSuccess('删除成功');
    }

    //--------------------------------------------文件归档--------------------------------------------------------------
    public function filesTab($enterprise_id,$readonly=0){
        $stage = [
            0=>['label'=>'全部文件'],
            1=>['label'=>'入库'],
            2=>['label'=>'研究'],
            3=>['label'=>'立项'],
            4=>['label'=>'尽调'],
            5=>['label'=>'投决'],
            6=>['label'=>'交割'],
            7=>['label'=>'管理'],
            8=>['label'=>'退出'],
        ];
        return $this->fetch('',['enterprise_id'=>$enterprise_id,'stage'=>$stage,'readonly'=>$readonly]);
    }
    public function files($enterprise_id,$stage=0,$pid=0,$readonly=0,$search=[],$page=1,$rows=DEFAULT_PAGE_ROWS)
    {
        $types = [
            0  => ['stage'=>0],
            3  => ['stage'=>1],
            10 => ['stage'=>2],
            21 => ['stage'=>2],
            4  => ['stage'=>4],
            5  => ['stage'=>4],
            6  => ['stage'=>4],
            7  => ['stage'=>4],
            27 => ['stage'=>4],
            9  => ['stage'=>5],
            11 => ['stage'=>5],
            12 => ['stage'=>6],
            13 => ['stage'=>6],
            14 => ['stage'=>6],
            15 => ['stage'=>6],
            16 => ['stage'=>6],
            17 => ['stage'=>6],
            18 => ['stage'=>6],
            20 => ['stage'=>6],
            22 => ['stage'=>6],
            19 => ['stage'=>7],
            23 => ['stage'=>8],
            24 => ['stage'=>8],
            25 => ['stage'=>8],
            26 => ['stage'=>8],
            28 => ['stage'=>5],
        ];
        if ($stage) {
            $types = array_filter($types,function($v) use ($stage){
                return $v['stage'] == $stage;
            });
        }
        if(request()->isGet()){
            return $this->fetch('',['enterprise_id'=>$enterprise_id,'types'=>$types,'stage'=>intval($stage),'readonly'=>$readonly]);
        }
        $where = ['external_id'=>$enterprise_id,'pid'=>$pid,'status'=>Defs::ATTACHMENT_OK];
        if (isset($search['type']) && $search['type'] !== '') {
            $where['attachment_type'] = $search['type'];
        } else {
            if (empty($types)) {
                return json([]);
            }
            $where['attachment_type'] = ['in',array_keys($types)];
        }
        if ($search['name']) {
            $where['original_name'] = ['like',"%{$search['name']}%"];
        }
        $total = Attachments::where($where)->count();
        if (empty($total)) {
            return json([]);
        }
        $files = Attachments::where($where)->page($page,$rows)->order('entered desc,attachment_id desc')->select();
        return json(['total'=>$total,'rows'=>$files]);
    }

    //项目退出管理
    public function exitList($enterprise_id,$page=1,$rows=DEFAULT_PAGE_ROWS,$readonly=0){
        if($this->request->isGet()){
            return $this->fetch('',[
                'enterprise_id'=>$enterprise_id,
                'readonly'=>$readonly,
            ]);
        }
        $where = ['enterprise_id'=>$enterprise_id];
        $count = Db::table('enterprises_dividends')->where($where)->count();
        if (empty($count)) {
            return '[]';
        }
        $items = Db::table('enterprises_dividends')->where($where)->page($page,$rows)->order('id DESC')->select();
        foreach ($items as $k=>$v) {
            $arr = empty($v['json']) ? [] : json_decode($v['json'],true);
            $items[$k]['fund_name'] = $arr['fund_id'] ? Db::table('funds')->where(['fund_id'=>$arr['fund_id']])->value('name') : '';
            $items[$k]['round'] = $arr['round'];
        }
        return json(['total'=>$count,'rows'=>$items, 'types'=>Defs::ENTERPRISE_EXIT_TYPES]);
    }

    //项目退出编辑
    public function exitEdit($enterprise_id, $id=0, $readonly=0)
    {
        if($this->request->isGet()){
            if ($id) {
                $row = Db::table('enterprises_dividends')->where('id',$id)->find();
                $json = $row['json'] ? json_decode($row['json'],true) : [];
            } else {
                $row = $json = [];
            }
            return $this->fetch('',[
                'enterprise_id'=>$enterprise_id,'row'=>$row,'json'=>$json,'readonly'=>$readonly,
                'url_upload'=>url('index/upload/'.($readonly?'viewAttaches':'attaches'),['externalId'=>$enterprise_id,'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_TABLE_STYLE]).'&callback=ENTERPRISE_EXIT_EDIT.uploaded'
            ]);
        }

        $req = input('post.');
        if ($req['json']) {
            $req['data']['json'] = json_encode($req['json']);
        }

        if (empty($id)) {
            $req['data']['enterprise_id'] = $enterprise_id;
//            dump($req['data']);die;
            $id = Db::table('enterprises_dividends')->insertGetId($req['data']);
            if ($req['pending_files']) {
                Upload::I()->relateAttaches($req['pending_files'], $enterprise_id, $id);
            }
        } else {
            Db::table('enterprises_dividends')->where(['id'=>$id])->update($req['data']);
        }

        return ajaxSuccess('保存成功');
    }

    //删除项目分红
    public function exitDelete($id) {
        Enterprise::I()->deleteDividend($id);
        return ajaxSuccess('删除成功');
    }

    //项目退出资金交割（分配到基金）
    public function exitFundAllocation($id)
    {
        if($this->request->isGet()){
            $exit = Edividends::get($id);
            $ffis = FundsFinanceIncomes::where('exit_id',$id)->column('ffi_id','fund_id');
            $funds = Enterprise::I()->getInvestFunds($exit['enterprise_id']);
            $e = Enterprise::I()->getEnterprise($exit['enterprise_id']);
            return $this->fetch('',[
                'ed'=>$exit,
                'funds'=>$funds,
                'ffis'=>$ffis ? $ffis : [],
                'ffi_title'=> $e['name'] . '-' . Defs::ENTERPRISE_EXIT_TYPES[$exit['type']]
            ]);
        }

        $ffi_id = $_POST['ffi_id'];
        if ($ffi_id) {
            Db::table('funds_finance_incomes')->where('ffi_id','in',$ffi_id)->update(['exit_id'=>$id]);
        }

        return ajaxSuccess('保存成功');
    }
}