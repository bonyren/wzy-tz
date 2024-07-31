<?php
 namespace app\index\logic; use app\index\model\Setting; use think\Debug; use think\Db; use think\Log; use think\Request; use think\Session; use app\index\service\RequestContext; use app\index\logic\Defs; use app\common\CommonDefs; use app\index\Logic\Milestones as MilestonesLogic; use app\index\model\Milestones as MilestonesModel; class ProgressLogs extends Base { const PROGRESS_LOG_ALL_CATEGORY = 0; const EVENT_LOG_FUND_MANAGE_CATEGORY = 2; const INVESTED_SUPPORT_CATEGORY = 5; const INVESTED_PROGRESS_CATEGORY = 6; const PROGRESS_LOG_PARTNER_CATEGORY = 7; const PROGRESS_LOG_SUB_INDUSTRY = 8; const PROGRESS_LOG_SCIENTIST_CATEGORY = 9; public static $progressLogCategoryDefs = array(self::EVENT_LOG_FUND_MANAGE_CATEGORY => "\345\x9f\xba\xe9\x87\x91\xe8\xbf\x9b\345\261\225\xe4\xba\x8b\344\xbb\266", self::INVESTED_SUPPORT_CATEGORY => "\346\212\x95\345\x90\x8e\346\x94\xaf\xe6\214\201", self::INVESTED_PROGRESS_CATEGORY => "\xe5\205\254\345\x8f\xb8\345\212\250\xe6\x80\201", self::PROGRESS_LOG_PARTNER_CATEGORY => "\345\x90\x88\344\274\x99\xe4\xba\xba\xe8\277\x9b\345\261\225", self::PROGRESS_LOG_SUB_INDUSTRY => "\xe5\xad\220\xe8\xa1\x8c\xe4\xb8\x9a\xe7\xa0\224\xe7\xa9\xb6", self::PROGRESS_LOG_SCIENTIST_CATEGORY => "\xe7\247\x91\xe5\255\xa6\xe5\xae\xb6\344\272\x8b\344\xbb\xb6"); public static $subtypes = array(1 => array("\156\141\x6d\145" => "\xe8\202\xa1\344\xb8\x9c\xe4\274\x9a\xe5\206\263\350\256\256", "\143\141\x74\x65\x67\x6f\x72\x79" => self::INVESTED_PROGRESS_CATEGORY), 2 => array("\156\141\x6d\x65" => "\350\x91\xa3\xe4\xba\213\xe4\xbc\232\345\x86\263\350\xae\xae", "\x63\141\164\145\147\x6f\x72\171" => self::INVESTED_PROGRESS_CATEGORY), 3 => array("\156\x61\x6d\145" => "\102\x72\x69\x64\147\x65\117\156\x65\40\x54\141\x6c\153", "\143\141\x74\x65\x67\157\162\x79" => self::PROGRESS_LOG_SCIENTIST_CATEGORY), 4 => array("\156\x61\155\x65" => "\346\x8a\225\345\x90\x8e\xe7\256\xa1\347\220\206", "\x63\141\x74\x65\147\157\x72\171" => self::PROGRESS_LOG_SCIENTIST_CATEGORY)); protected function __construct() { parent::__construct(); } public function load($search = array(), $page = 1, $rows = DEFAULT_PAGE_ROWS, $sort = "\x70\x72\157\147\162\145\163\163\137\154\157\147\x5f\151\x64", $order = "\x64\x65\x73\x63", $category = self::PROGRESS_LOG_ALL_CATEGORY, $externalId = 0) { goto pMqAm; XvIVl: if (!$search["\145\156\x74\x65\x72\x65\144"]) { goto F2Agi; } goto XlSki; vRhDb: return ["\164\x6f\164\141\154" => $totalCount, "\x72\x6f\167\163" => $records]; goto hS_Gi; D0s3F: $conditions["\143\x61\164\145\x67\x6f\162\171"] = $category; goto ernwB; ghaS6: if (!($search["\x73\162\x63"] == CommonDefs::MODULE_PROJECT)) { goto ZjLZR; } goto YeBaB; yL2Dd: $contacts = Db::table("\143\x6f\156\164\x61\x63\x74\163")->where("\151\144", "\x69\156", $contact_ids)->column("\156\x61\x6d\145", "\x69\144"); goto epWTr; epWTr: $admins = Db::table("\141\144\x6d\151\x6e\163")->where("\141\x64\x6d\151\x6e\137\x69\144", "\151\156", $admin_ids)->column("\x72\145\141\x6c\x6e\141\x6d\145", "\141\x64\x6d\151\156\x5f\x69\x64"); goto BoMaQ; V8Ei5: yso0K: goto vRhDb; XlSki: $conditions["\x6f\143\x63\165\162\x5f\x64\x61\x74\145"] = $search["\x65\x6e\164\145\x72\x65\144"]; goto EV_Lk; P9ou7: ZjLZR: goto yOpDQ; WIFgE: wjcIR: goto ek6a9; gEISg: goto ip2lM; goto WIFgE; BoMaQ: foreach ($records as $k => $v) { goto jMWS6; ngn2_: goto GrCAT; goto nHcGT; PKO2O: qloBN: goto mUGFh; Hnvi0: $records[$k]["\162\x65\141\154\156\141\155\145"] = $contacts[$v["\x63\157\156\164\141\143\164\137\x69\x64"]] . "\xef\274\210\351\xa1\xb9\xe7\233\256\xe6\226\xb9\xef\xbc\x89"; goto PnolH; jMWS6: if ($v["\x63\157\x6e\164\x61\x63\x74\137\x69\144"]) { goto HJuBA; } goto Q3RrA; nHcGT: HJuBA: goto Hnvi0; PnolH: GrCAT: goto PKO2O; Q3RrA: $records[$k]["\162\x65\141\154\x6e\x61\x6d\x65"] = $admins[$v["\x61\144\x6d\x69\156\137\151\144"]]; goto ngn2_; mUGFh: } goto V8Ei5; kX4HS: $conditions = ["\145\x78\x74\145\162\156\x61\154\x5f\x69\x64" => $externalId]; goto Qg9Ju; YeBaB: $p_user = \app\p\service\User::I()->getLoginUser(); goto TYXin; EV_Lk: F2Agi: goto ghaS6; Cy2Q8: $admin_ids = []; goto KtCXS; INCpm: Z1r37: goto yL2Dd; TYXin: $conditions["\x63\x6f\156\x74\141\143\164\x5f\x69\x64"] = $p_user["\x69\x64"]; goto P9ou7; KtCXS: $contact_ids = []; goto ft7_9; vhM0Q: $order = "\160\162\157\147\x72\x65\163\163\x5f\x6c\157\x67\137\x69\144\40\x64\145\x73\143"; goto gEISg; pMqAm: $limit = ($page - 1) * $rows . "\54" . $rows; goto s1_gY; Qg9Ju: if (!$category) { goto UESLa; } goto D0s3F; T_UpY: ip2lM: goto kX4HS; yOpDQ: $totalCount = Db::table("\x70\162\157\147\x72\145\x73\x73\137\154\x6f\147\163")->where($conditions)->count(); goto RnnxU; ft7_9: foreach ($records as $v) { goto NGMw8; mJhaO: wcHTa: goto ad7_j; Xq86o: $contact_ids[$v["\143\x6f\x6e\x74\x61\143\x74\x5f\x69\144"]] = $v["\143\x6f\156\x74\x61\x63\164\x5f\151\144"]; goto mJhaO; NGMw8: $admin_ids[$v["\141\x64\x6d\151\x6e\137\x69\x64"]] = $v["\x61\x64\155\151\x6e\137\151\x64"]; goto Xq86o; ad7_j: } goto INCpm; ek6a9: $order = "\x70\162\x6f\x67\x72\x65\163\x73\x5f\x6c\x6f\147\137\x69\x64\x20" . $order; goto T_UpY; s1_gY: if ($sort == "\x70\x72\157\x67\x72\145\163\163\x5f\154\157\x67\137\151\144") { goto wjcIR; } goto vhM0Q; ernwB: UESLa: goto XvIVl; RnnxU: $records = Db::table("\x70\x72\157\x67\x72\x65\x73\163\137\154\x6f\147\x73")->where($conditions)->limit($limit)->order($order)->select(); goto Cy2Q8; hS_Gi: } public function get($id) { goto OiZkF; VXNNm: IK2Q5: goto o1GE6; CElX1: return []; goto VXNNm; tRZoE: return $row; goto F6KWL; o1GE6: $row["\145\170\x74\162\141\163"] = empty($row["\x65\x78\164\162\x61\x73"]) ? null : json_decode($row["\x65\x78\x74\162\141\x73"], true); goto tRZoE; hRXfz: if (!empty($row)) { goto IK2Q5; } goto CElX1; OiZkF: $row = Db::table("\160\162\157\x67\x72\x65\x73\x73\x5f\154\157\147\x73")->where("\x70\x72\x6f\147\x72\x65\163\163\x5f\x6c\x6f\147\137\151\x64", $id)->find(); goto hRXfz; F6KWL: } public function add($category, $externalId, $infos) { goto HA8jT; PYdmH: $datas["\x63\x6f\156\164\141\143\164\x5f\151\144"] = intval($p_user["\151\144"]); goto wrG6q; U6mBY: $datas["\164\151\x74\154\x65"] = !emptyInArray($infos, "\164\151\164\x6c\x65") ? $infos["\x74\x69\x74\154\x65"] : ''; goto wLxyB; W_XLc: $datas["\145\x6e\x74\x65\162\145\x64"] = date("\x59\55\x6d\x2d\x64\x20\110\72\x69\72\x73"); goto xlHZ0; El8J6: $datas["\x73\150\157\167\137\164\x69\155\x65\154\151\x6e\145"] = 0; goto C2pAF; xKqRW: Njo9R: goto HuWA6; C2pAF: if (emptyInArray($infos, "\163\150\x6f\167\x5f\x74\x69\155\145\154\151\x6e\x65")) { goto ZSvbW; } goto JJYxC; HA8jT: $datas = []; goto eyyzs; HAhoe: MilestonesLogic::I()->save(MilestonesModel::MILESTONE_FUND_CATEGORY, $externalId, $datas["\157\143\143\165\162\x5f\x64\141\164\145"], $datas["\x74\151\x74\154\x65"]); goto PJEc7; HOX0L: $datas["\x6f\143\x63\165\x72\137\x64\x61\164\x65"] = !emptyInArray($infos, "\157\x63\143\x75\162\137\x64\x61\x74\x65") ? $infos["\157\x63\143\165\x72\137\x64\141\x74\x65"] : Defs::DEFAULT_DB_DATE_VALUE; goto U6mBY; HuWA6: $p_user = \app\p\service\User::I()->getLoginUser(); goto PYdmH; T100e: f3sII: goto nN5sa; dqJRJ: if (!$datas["\x73\x68\157\167\x5f\x74\151\x6d\145\x6c\151\x6e\145"]) { goto WTscV; } goto HAhoe; wrG6q: YnUtw: goto El8J6; cUCsV: if (!$infos["\x61\164\164\141\143\150\145\x73"]) { goto f3sII; } goto LbRTl; wLxyB: $datas["\x65\156\x74\162\171"] = !emptyInArray($infos, "\145\156\x74\x72\171") ? $infos["\145\156\x74\x72\171"] : ''; goto W_XLc; n6UXy: goto YnUtw; goto xKqRW; LbRTl: Upload::I()->relateAttaches($infos["\141\164\164\x61\143\x68\x65\x73"], $newProgressLogId); goto T100e; PJEc7: WTscV: goto LxeNw; eyyzs: $datas["\x63\x61\164\x65\x67\157\162\x79"] = $category; goto qAvsW; JJYxC: $datas["\x73\x68\x6f\x77\137\164\151\155\145\154\x69\156\145"] = intval($infos["\x73\x68\157\x77\137\x74\151\x6d\145\154\151\156\145"]); goto nC13K; nN5sa: return true; goto fyQEp; SlXSO: $datas["\145\x78\x74\145\x72\156\141\154\137\151\x64"] = $externalId; goto HOX0L; xlHZ0: if ($infos["\163\162\x63"] == CommonDefs::MODULE_PROJECT) { goto Njo9R; } goto e2f11; qAvsW: $datas["\163\x75\142\x74\171\160\145"] = intval($infos["\163\x75\142\164\x79\160\x65"]); goto SlXSO; e2f11: $datas["\141\144\155\x69\156\137\151\144"] = intval(RequestContext::I()->loginUserId); goto n6UXy; nC13K: ZSvbW: goto dqJRJ; LxeNw: $newProgressLogId = Db::table("\x70\162\157\147\162\x65\x73\x73\x5f\154\157\x67\163")->insertGetId($datas); goto cUCsV; fyQEp: } public function delete($progressLogId) { goto LeEAt; vKktO: return $result > 0 ? true : false; goto mDzAI; ilv_K: $result = Db::table("\160\162\157\x67\162\145\x73\163\137\x6c\x6f\x67\163")->where("\160\162\x6f\147\162\145\x73\x73\137\154\x6f\147\x5f\x69\x64", $progressLogId)->delete(); goto vKktO; LeEAt: Upload::I()->deleteAttaches($progressLogId, Upload::ATTACH_PROGRESS_LOGS); goto ilv_K; mDzAI: } }