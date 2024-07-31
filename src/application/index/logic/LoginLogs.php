<?php
 namespace app\index\logic; use app\index\model\Setting; use think\Debug; use think\Db; use think\Log; use think\Request; use think\Session; class LoginLogs extends Base { const LOGIN_USER_ADMIN_TYPE = 1; const LOGIN_USER_PARTNER_TYPE = 2; public static $loginUserTypeDefs = array(self::LOGIN_USER_ADMIN_TYPE => "\xe7\xae\241\347\x90\x86\xe5\x91\x98", self::LOGIN_USER_PARTNER_TYPE => "\345\x90\210\xe4\xbc\x99\344\272\xba"); public static $loginUserTypeHtmlDefs = array(self::LOGIN_USER_ADMIN_TYPE => "\x3c\x73\160\x61\x6e\40\143\154\141\163\x73\75\x22\142\141\144\147\x65\x20\142\141\144\147\x65\x2d\160\x72\x69\x6d\x61\162\x79\42\76\347\256\241\347\x90\206\345\x91\x98\74\x2f\163\160\x61\156\76", self::LOGIN_USER_PARTNER_TYPE => "\74\163\160\141\156\x20\x63\154\x61\x73\x73\75\42\x62\141\x64\147\145\x20\142\141\144\x67\x65\x2d\163\165\143\143\x65\163\x73\42\76\345\x90\210\344\xbc\x99\344\xba\xba\x3c\x2f\163\x70\141\156\76"); protected function __construct() { parent::__construct(); } public function load($search = array(), $page = 1, $rows = DEFAULT_PAGE_ROWS, $sort = "\x69\x64", $order = "\x64\x65\x73\143") { goto zAz5g; arId9: goto zzFth; goto KkB7p; eEcMV: tIbfq: goto arId9; KkB7p: wYIDD: goto wEWHk; PJ9bl: $order = "\x69\144\40\144\x65\163\x63"; goto m65r4; GiEqN: if ($sort == "\151\144") { goto wYIDD; } goto qRhI7; g9poI: $order = "\164\x69\155\x65\x20" . $order; goto eEcMV; iQMo9: $totalCount = Db::table("\154\x6f\147\151\156\137\x6c\x6f\x67\163")->where($conditions)->count(); goto o1HLs; w6vB6: FpwUN: goto iQMo9; m65r4: goto tIbfq; goto aG63n; o1HLs: $records = Db::table("\x6c\157\147\151\x6e\x5f\154\x6f\x67\x73")->where($conditions)->order($order)->limit($limit)->field(true)->select(); goto p3v49; wEWHk: $order = "\x69\x64\x20" . $order; goto zWMP8; zWMP8: zzFth: goto S_zkW; zAz5g: $limit = ($page - 1) * $rows . "\54" . $rows; goto GiEqN; S_zkW: $conditions = []; goto ouaCC; qRhI7: if ($sort == "\164\151\x6d\145") { goto tKkRe; } goto PJ9bl; ouaCC: if (emptyInArray($search, "\165\x73\145\x72\x6e\141\155\x65")) { goto FpwUN; } goto Tbues; p3v49: return ["\164\157\164\141\154" => $totalCount, "\x72\157\x77\163" => $records]; goto r2jna; aG63n: tKkRe: goto g9poI; Tbues: $conditions["\x75\x73\145\x72\x6e\141\x6d\x65"] = ["\154\x69\x6b\145", "\45" . $search["\x75\x73\x65\x72\x6e\141\x6d\145"] . "\45"]; goto w6vB6; r2jna: } public function add($username, $userid, $usertype, $useragent, $ip) { Db::table("\154\x6f\147\151\x6e\x5f\154\x6f\x67\x73")->insert(["\x75\x73\145\x72\156\141\x6d\145" => $username, "\x75\x73\145\162\151\x64" => $userid, "\x75\163\145\162\164\171\160\145" => $usertype, "\165\x73\145\162\141\147\x65\x6e\164" => $useragent, "\144\x65\x76\x69\143\145" => Request::instance()->isMobile() ? \app\index\model\Base::AUDIT_LOG_MOBILE_DEVICE : \app\index\model\Base::AUDIT_LOG_DESKTOP_DEVICE, "\x69\160" => $ip, "\x74\151\155\x65" => Db::raw("\156\157\167\x28\x29")]); } }
