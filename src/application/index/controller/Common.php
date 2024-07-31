<?php
 namespace app\index\controller; use think\Controller; use think\Session; use think\Request; use think\Log; use think\Db; use app\index\service\RequestContext; use app\common\CommonDefs; class Common extends Controller { protected $loginUserId = null; protected $loginUserName = null; protected $loginRealName = null; protected $loginUserRoleId = null; protected $loginSuperUser = false; protected $loginTime = null; protected $loginIp = null; protected $loginMobile = null; protected $loginUserMenuPriv = null; public function _initialize() { goto RaTb0; gcf29: $this->assign("\137\x72\145\161\x75\145\x73\164\137\165\162\154", $this->request->url()); goto hK093; RaTb0: $this->loginUserId = Session::get("\165\163\x65\x72\x69\x64"); goto WL4TL; C3J_Q: RequestContext::I()->loginMobile = $this->loginMobile; goto v8oh_; YLOcU: $this->loginTime = Session::get("\x6c\x61\x73\164\x6c\157\147\151\x6e\x74\x69\x6d\x65"); goto N0LCl; bkSyT: $this->loginSuperUser = Session::get("\x73\165\160\x65\162\137\165\x73\x65\x72"); goto b8QOe; BAu6E: $this->assign("\154\157\147\151\156\x55\x73\145\162\115\145\156\165\x50\x72\151\x76", $this->loginUserMenuPriv); goto gcf29; OiodH: RequestContext::I()->loginIp = $this->loginIp; goto tKRgC; WL4TL: $this->loginUserName = Session::get("\x75\163\x65\x72\x6e\x61\155\x65"); goto JqVM6; v8oh_: self::checkLogin(); goto Uy7ex; jzj3j: RequestContext::I()->loginUserRoleId = $this->loginUserRoleId; goto Ua727; Ua727: RequestContext::I()->loginTime = $this->loginTime; goto OiodH; gnFyo: $this->loginUserRoleId = Session::get("\x75\163\x65\x72\162\157\154\x65\151\x64"); goto YLOcU; N0LCl: $this->loginIp = Session::get("\x6c\141\163\x74\154\157\x67\x69\156\x69\160"); goto bkSyT; Uy7ex: self::checkPriv(); goto BJJ5O; tKRgC: RequestContext::I()->loginSuperUser = $this->loginSuperUser; goto C3J_Q; JqVM6: $this->loginRealName = Session::get("\x72\x65\141\x6c\156\x61\x6d\x65"); goto gnFyo; Jd3vE: RequestContext::I()->loginUserName = $this->loginUserName; goto jzj3j; b8QOe: $this->loginMobile = request()->isMobile(); goto oK3bW; oK3bW: RequestContext::I()->loginUserId = $this->loginUserId; goto Jd3vE; BJJ5O: $this->assign("\x6c\157\147\x69\156\115\x6f\x62\x69\x6c\x65", $this->loginMobile); goto BAu6E; hK093: } public final function checkLogin() { goto L0RX0; eNYt5: if (request()->isAjax()) { goto p7up2; } goto uq8TT; JXoj5: return; goto iO0jM; FdDSU: goto S0uB3; goto KHM6b; BMmEr: exit; goto F3QpP; aCQns: return; goto d_yix; kuiax: if (!($controller == "\111\x6e\144\x65\x78" && in_array($action, array("\x6c\x6f\147\x69\x6e", "\x63\141\160\x74\143\150\x61")))) { goto CgA3g; } goto cUJnW; KHM6b: p7up2: goto S2lQa; j2k2J: aLlpV: goto FdDSU; G5ScW: S0uB3: goto dxvRk; KTyAy: exit; goto G5ScW; d_yix: cYjAa: goto eNYt5; q3r17: return; goto cuxQW; YSH1_: CgA3g: goto to9ac; S2lQa: header("\x48\x54\124\120\x2f\61\56\x31\x20\x34\x30\x31\40\125\x6e\x61\165\164\x68\x6f\x72\151\x7a\145\x64"); goto KTyAy; L0RX0: $controller = Request::instance()->controller(); goto EKRHr; YhMaI: $this->redirect("\x69\156\144\145\170\57\x49\x6e\144\x65\x78\57\x6c\x6f\x67\x69\156"); goto j2k2J; enEvJ: Log::notice("\103\x6f\155\155\x6f\156\103\x6f\156\x74\162\157\154\x6c\x65\x72\x3a\72\x63\x68\145\x63\153\x4c\157\x67\151\156\54\x20\160\154\145\x61\163\145\x20\154\x6f\147\151\156\40\x66\x69\x72\163\164\154\x79\54\40\x73\145\163\x73\151\x6f\x6e\72\40" . var_export($_SERVER, true) . "\x2c\x20\165\162\x6c\72" . url("\x69\x6e\x64\145\x78\57\x49\x6e\x64\145\170\57\x6c\157\147\151\x6e")); goto YhMaI; Oh5hZ: if (!session("\x6c\x70")) { goto PE2pg; } goto JXoj5; cUJnW: return; goto YSH1_; EKRHr: $action = Request::instance()->action(); goto kuiax; iO0jM: PE2pg: goto FozHM; F3QpP: goto aLlpV; goto qXm71; uq8TT: if (!request()->isAjax()) { goto DNd84; } goto BMmEr; qXm71: DNd84: goto enEvJ; FozHM: if (!$this->loginUserId) { goto cYjAa; } goto aCQns; cuxQW: dypEX: goto Oh5hZ; to9ac: if (!\app\p\service\User::I()->getLoginUser()) { goto dypEX; } goto q3r17; dxvRk: } public final function checkPriv() { goto qYDTK; ucMad: ahu4J: goto s_fCq; x6n24: d6UYZ: goto ka3yb; qYDTK: if (!$this->loginSuperUser) { goto E7iFX; } goto gDYou; cFjjF: $controller = Request::instance()->controller(); goto SjgPl; gDYou: $this->loginUserMenuPriv = CommonDefs::AUTHORIZE_READ_WRITE_TYPE; goto XDqpg; yqfxj: return; goto ucMad; VwTkT: $menuIds = Db::table("\155\145\x6e\x75")->where(["\155" => $module, "\x63" => $controller, "\141" => $action])->column("\151\144"); goto TwUf4; RMTeE: if (!($authorizeType === null)) { goto d6UYZ; } goto h42X8; TwUf4: if (!empty($menuIds)) { goto ahu4J; } goto nMiKI; ka3yb: $this->loginUserMenuPriv = intval($authorizeType); goto mTHC3; rXrI1: $this->loginUserMenuPriv = CommonDefs::AUTHORIZE_READ_WRITE_TYPE; goto HCXuN; HCXuN: return; goto qMpFm; qcWxO: return; goto x6n24; BU_Kg: E7iFX: goto sdQdZ; sdQdZ: if (Request::instance()->isGet()) { goto S3ti4; } goto rXrI1; XDqpg: return; goto BU_Kg; h42X8: exit("\x3c\x64\x69\x76\x20\163\164\171\154\145\75\x22\x70\141\x64\144\x69\x6e\147\x3a\66\x70\x78\42\x3e\346\x82\250\346\262\241\346\234\211\346\x9d\203\351\x99\220\xe6\x93\x8d\xe4\xbd\234\350\257\xa5\xe9\xa1\xb9\x3c\x2f\x64\x69\166\76"); goto qcWxO; nMiKI: $this->loginUserMenuPriv = CommonDefs::AUTHORIZE_READ_WRITE_TYPE; goto yqfxj; sByEo: $module = Request::instance()->module(); goto cFjjF; SjgPl: $action = Request::instance()->action(); goto VwTkT; qMpFm: S3ti4: goto sByEo; s_fCq: $authorizeType = Db::table("\141\144\155\x69\x6e\137\x72\157\154\x65\137\155\145\156\x75")->where(["\x6d\145\156\x75\x5f\151\x64" => ["\x69\156", $menuIds], "\x72\x6f\x6c\145\x5f\x69\x64" => $this->loginUserRoleId])->value("\x74\171\x70\x65"); goto RMTeE; mTHC3: } }
