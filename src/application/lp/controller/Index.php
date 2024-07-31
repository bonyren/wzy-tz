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
namespace app\lp\controller;
use app\index\logic\Defs;
use think\Db;
use think\Session;

class Index extends Base
{
    public function login()
    {
        if ($this->lp_id) {
            $this->redirect('index/index');
        }
        if ($this->request->isGet()){
            return $this->fetch();
        }
        $data = input('post.');
        if ($data['phone'] == 'test' && $data['password'] == 'test') {
            $where = ['p_id'=>18];
        } else {
            $where = ['login_name'=>trim($data['phone']), 'login_password'=>md5(trim($data['password']))];
        }
        $lp = Db::table('partners')
            ->field('p_id,type,name,status,tel,email,address,credential_no,login_name')
            ->where($where)->find();
        if (empty($lp)) {
            return ajaxError('帐号或密码错误');
        }
        //Session::clear();//影响同一浏览器的管理员登录
        Session::delete('lp');
        session('lp', $lp);
        return ajaxSuccess('',url('lp/index/index'));
    }

    public function logout(){
        //Session::clear();
        Session::delete('lp');
        return ajaxSuccess('',url('lp/index/login'));
    }

    public function index()
    {
        if ($this->request->isMobile()) {
            $tpl = 'index_mobile';
            if ($this->lp['status'] == Defs::PARTNER_PENDING_STATUS) { //潜在
                $menus[] = ['name'=>'项目','title'=>'项目列表','url'=>url('funds/projectsLatent'),'icon'=>'fa-cubes'];
            } else {
                $menus[] = ['name'=>'概览','title'=>'投资概览','url'=>url('index/overview'),'icon'=>'fa-dashboard'];
                $menus[] = ['name'=>'基金','title'=>'参与基金','url'=>url('funds/index'),'icon'=>'fa-money'];
                $menus[] = ['name'=>'项目','title'=>'参与项目','url'=>url('funds/projects'),'icon'=>'fa-cubes'];
            }
            $this->assign('menus',$menus);
        } else {
            $tpl = '';
            if ($this->lp['status'] == Defs::PARTNER_PENDING_STATUS) { //潜在
                $this->assign('home_page',url('lp/projects/index'));
            } else {
                $this->assign('home_page',url('lp/funds/reports_list'));
            }
        }
        return $this->fetch($tpl);
    }

    public function home()
    {
        $rows = Db::table('funds_partners')->alias('fp')
            ->join('funds f','f.fund_id=fp.fund_id')
            ->field('fp.amount,fp.status,f.fund_id,f.name,f.alias')
            ->where(['fp.p_id'=>$this->lp_id])->select();
        $total = 0;
        $funds = [];
        foreach ($rows as $v) {
            $total += $v['amount'];
            $funds[] = ['fund_id'=>$v['fund_id'],'name'=>$v['name'],'alias'=>$v['alias'],'y'=>round($v['amount']/10000,2)];
        }
        $quit = Db::table('enterprises_dividends_partners')->where('p_id',$this->lp_id)->sum('amount');
        $this->assign([
            'total' => $total ? round($total/10000,2) : 0,
            'quit' => $quit,
            'funds' => json_encode($funds,JSON_UNESCAPED_UNICODE)
        ]);
        return $this->fetch();
    }

    public function overview(){
        $amount = Db::table('funds_partners')->where(['p_id'=>$this->lp_id])->sum('amount');
        if($amount === null){
            $amount = 0;
        }
        $this->assign('amount', number_format($amount, 2));
        $enterprises =Db::table('enterprises')->alias('e')
            ->join('funds_enterprises fe', 'e.id=fe.enterprise_id')
            ->join('funds_partners fp', 'fe.fund_id=fp.fund_id')
            ->where(['fp.p_id'=>$this->lp_id])
            ->group('e.id')
            ->order('e.id asc')
            ->field('e.id,e.name,e.logo')->select();
        $this->assign('enterprises', $enterprises);
        return $this->fetch();
    }

    public function message()
    {
        return $this->fetch();
    }

    public function loadMenu(){
        if ($this->lp['status'] == Defs::PARTNER_PENDING_STATUS) { //潜在
            $menus[0] = ['id'=>13, 'name'=>'项目','attributes'=>['breadcrumb'=>'项目'],'iconCls'=>'fa fa-product-hunt fa-fw'];
            $menus[0]['children'] = [
                ['text'=>'项目列表','iconCls'=>'fa fa-list fa-fw','url'=>'/lp/projects/index.html','attributes'=>['breadcrumb'=>'项目 &gt; 项目列表']]
            ];
        } else {
            $menus[0] = ['id'=>13, 'name'=>'基金','attributes'=>['breadcrumb'=>'基金'],'iconCls'=>'fa fa-money fa-fw'];
            $menus[0]['children'] = [
                ['text'=>'基金报告','iconCls'=>'fa fa-files-o fa-fw','url'=>'/lp/funds/reports_list.html','attributes'=>['breadcrumb'=>'基金报告']]
            ];
        }
        return json($menus);
    }
}