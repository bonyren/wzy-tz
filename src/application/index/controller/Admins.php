<?php
 namespace app\index\controller; use think\Controller; use think\Log; use think\Debug; use think\Request; class Admins extends Common { public function admins($search = array(), $page = 1, $rows = DEFAULT_PAGE_ROWS, $sort = "\141\144\x6d\151\156\137\151\x64", $order = "\x64\145\163\x63") { goto Pa86Y; dUC_2: sWX3X: goto L4NCM; G8wbz: $this->assign("\x75\x72\x6c\110\162\145\146\x73", $urlHrefs); goto b8GFv; Pa86Y: if (!request()->isGet()) { goto sWX3X; } goto VKIhA; VKIhA: $urlHrefs = ["\x61\x64\155\x69\x6e\163" => url("\151\156\144\x65\170\x2f\101\144\x6d\151\156\x73\x2f\141\144\155\151\x6e\163"), "\141\x64\155\151\x6e\x73\101\144\144" => url("\151\x6e\x64\x65\x78\x2f\x41\x64\155\151\156\163\57\141\144\155\x69\156\x73\101\144\144"), "\x61\x64\155\x69\156\163\x45\x64\151\x74" => url("\x69\156\144\x65\170\x2f\x41\144\x6d\x69\x6e\163\x2f\x61\144\155\151\156\163\105\x64\x69\164"), "\141\144\155\x69\x6e\163\x44\x65\154\x65\x74\x65" => url("\151\x6e\x64\x65\170\x2f\101\x64\155\x69\156\163\57\141\144\155\x69\x6e\163\104\x65\x6c\x65\164\145"), "\141\144\155\151\156\x73\x43\150\141\156\147\x65\120\167\144" => url("\151\156\144\x65\170\57\101\x64\x6d\151\x6e\163\57\x61\x64\x6d\x69\156\163\x43\x68\141\156\x67\x65\120\167\144")]; goto G8wbz; L4NCM: $adminsLogic = \app\index\logic\Admins::newObj(); goto CxMu9; CxMu9: return json($adminsLogic->load($search, $page, $rows, $sort, $order)); goto jLu4e; b8GFv: return $this->fetch(); goto dUC_2; jLu4e: } public function adminsAdd() { goto yC1b6; odPZB: vfN67: goto KwBL8; Df11n: goto vfN67; goto maNb_; Qm08i: if ($result) { goto Hnvap; } goto C3Kqr; OaWV_: $this->assign("\x62\x69\156\x64\x56\141\154\x75\x65\x73", $bindValues); goto aHe62; iPDpA: $infos = input("\160\157\163\164\x2e\151\x6e\146\157\163\57\x61"); goto niJp7; zjtjA: $bindValues = ["\x61\144\155\151\x6e\122\x6f\154\145\x50\141\151\162\163" => $adminsLogic->getAdminRolePairs()]; goto OaWV_; C3Kqr: return ajaxError("\345\xa4\261\350\264\xa5"); goto Df11n; U1d0V: if (!request()->isGet()) { goto ly8fU; } goto CUEp0; Q1ON9: ly8fU: goto iPDpA; CUEp0: $urlHrefs = ["\x63\x68\x65\143\153\101\144\155\x69\x6e\105\155\141\x69\x6c" => url("\x69\x6e\x64\145\170\x2f\101\144\155\x69\x6e\x73\57\143\x68\145\x63\153\x41\x64\x6d\151\156\105\x6d\141\151\154", ["\x6f\x6c\x64\126\x61\x6c\x75\145" => ''])]; goto LXs2a; aHe62: return $this->fetch(); goto Q1ON9; NGpu7: return ajaxSuccess("\346\x88\x90\345\x8a\x9f"); goto odPZB; niJp7: $result = $adminsLogic->addAdmin($infos); goto Qm08i; LXs2a: $this->assign("\x75\x72\x6c\110\162\x65\x66\163", $urlHrefs); goto zjtjA; maNb_: Hnvap: goto NGpu7; yC1b6: $adminsLogic = \app\index\logic\Admins::newObj(); goto U1d0V; KwBL8: } public function adminsEdit($adminId) { goto Co1qh; a9kcP: if ($result) { goto zEM3P; } goto d0LKt; X0Vgk: zEM3P: goto DC7Se; FxKwe: return $this->fetch("\143\157\x6d\x6d\x6f\x6e\57\x65\x72\x72\x6f\162"); goto z2DBP; FZUC5: $urlHrefs = ["\143\x68\145\x63\153\x41\144\155\x69\x6e\x45\155\141\151\x6c" => url("\151\x6e\144\145\170\x2f\x41\144\155\151\156\x73\x2f\143\x68\145\143\x6b\x41\144\x6d\x69\156\105\x6d\x61\x69\x6c", ["\157\x6c\144\x56\x61\154\165\145" => $infos["\145\155\141\151\x6c"]])]; goto eecOZ; Mlqq8: goto aF7KS; goto X0Vgk; Gy6vG: $infos = input("\160\x6f\x73\x74\x2e\x69\156\x66\157\x73\x2f\141"); goto RPBKv; eecOZ: $this->assign("\165\x72\154\x48\162\145\146\x73", $urlHrefs); goto NB80d; Z0i6p: $this->assign("\142\x69\156\x64\126\x61\x6c\165\145\163", $bindValues); goto FZUC5; d0LKt: return ajaxError("\345\244\261\xe8\264\xa5"); goto Mlqq8; NB80d: return $this->fetch(); goto h7cjB; RPBKv: $result = $adminsLogic->editAdmin($adminId, $infos); goto a9kcP; Co1qh: $adminsLogic = \app\index\logic\Admins::newObj(); goto QfRVV; QfRVV: if (!request()->isGet()) { goto qF4tn; } goto p0BHb; h7cjB: qF4tn: goto Gy6vG; p0BHb: $infos = $adminsLogic->getAdminInfos($adminId); goto Jn38o; DC7Se: return ajaxSuccess("\346\210\x90\xe5\212\237"); goto ttoYV; z2DBP: wSd8q: goto PZcTa; ttoYV: aF7KS: goto d7uxc; PZcTa: $bindValues = ["\x61\x64\x6d\151\x6e\x52\x6f\154\x65\x50\141\151\x72\x73" => $adminsLogic->getAdminRolePairs(), "\x69\x6e\146\x6f\x73" => $infos]; goto Z0i6p; Jn38o: if ($infos) { goto wSd8q; } goto FxKwe; d7uxc: } public function adminsDelete($adminId) { goto P5trK; rLWcq: goto AH7U9; goto qodyN; DydDZ: $result = $adminsLogic->deleteAdmin($adminId); goto SmYX6; qodyN: ti_Jk: goto KMqsd; SmYX6: if ($result) { goto ti_Jk; } goto elZgQ; taFpU: AH7U9: goto XfnaY; KMqsd: return ajaxSuccess("\xe6\x88\220\xe5\x8a\x9f"); goto taFpU; P5trK: $adminsLogic = \app\index\logic\Admins::newObj(); goto DydDZ; elZgQ: return ajaxError("\345\xa4\261\xe8\xb4\245"); goto rLWcq; XfnaY: } public function adminsChangePwd($adminId) { goto egK_e; A7y98: if ($infos) { goto cwIGU; } goto QgNYK; V73vn: RhOI3: goto vS8bp; jrg6v: $bindValues = ["\151\x6e\146\x6f\x73" => $infos]; goto QJiDx; or8JU: cwIGU: goto jrg6v; k5K8X: vSYXk: goto mA5Oo; QgNYK: return $this->fetch("\143\x6f\155\x6d\157\156\57\x65\162\x72\x6f\162"); goto or8JU; KQpLI: $infos = $adminsLogic->getAdminInfos($adminId); goto A7y98; LsciU: goto RhOI3; goto ZXE5k; wGlYc: if ($result) { goto NsO1x; } goto KUqk4; x7Eva: if (!request()->isGet()) { goto vSYXk; } goto KQpLI; mA5Oo: $infos = input("\x70\x6f\x73\164\56\x69\156\146\157\163\x2f\141"); goto sZBH4; QpDBr: return $this->fetch(); goto k5K8X; o5veZ: return ajaxSuccess("\xe6\x88\220\xe5\212\x9f"); goto V73vn; KUqk4: return ajaxError("\xe5\244\xb1\350\264\245"); goto LsciU; QJiDx: $this->assign("\x62\x69\156\x64\x56\141\x6c\165\x65\163", $bindValues); goto QpDBr; ZXE5k: NsO1x: goto o5veZ; egK_e: $adminsLogic = \app\index\logic\Admins::newObj(); goto x7Eva; sZBH4: $result = $adminsLogic->changeAdminPwd($adminId, $infos); goto wGlYc; vS8bp: } public function checkAdminEmail($oldValue, $email) { goto MHf2I; i9Y6A: q3363: goto SXZhP; x2Luk: return "\164\162\x75\x65"; goto owIWO; pYxi1: i14To: goto iwnqv; fELKw: $exists = false; goto i66TO; i66TO: if ($exists) { goto q3363; } goto oBBeK; WOMDi: goto i14To; goto i9Y6A; MHf2I: if (!($oldValue == $email)) { goto K21Gm; } goto x2Luk; owIWO: K21Gm: goto fELKw; oBBeK: return "\x74\x72\x75\x65"; goto WOMDi; SXZhP: return "\x66\x61\x6c\x73\145"; goto pYxi1; iwnqv: } public function getUsersById($ids) { goto a6pwZ; WpnU9: return json($rows); goto Dlq33; js6_y: IuNZ6: goto WpnU9; J2fUP: $rows = db("\x61\144\155\x69\x6e\163")->field("\x61\x64\x6d\x69\156\x5f\151\144\54\x65\x6d\x61\151\154\54\x72\145\x61\x6c\x6e\141\155\x65")->where($where)->order("\141\x64\155\151\156\137\151\144\x20\141\163\143")->select(); goto KYNr_; vU26T: uiF7I: goto eqiDb; UEIjq: $rows = []; goto js6_y; a6pwZ: if (is_array($ids)) { goto uiF7I; } goto J_nP5; eqiDb: $where["\x61\x64\x6d\x69\x6e\137\151\144"] = isset($ids[1]) ? ["\x69\x6e", $ids] : $ids[0]; goto J2fUP; J_nP5: $ids = explode("\54", $ids); goto vU26T; KYNr_: if (!empty($rows)) { goto IuNZ6; } goto UEIjq; Dlq33: } public function getAllUsers() { $rows = \app\index\logic\Admins::I()->getAllUsers(false); return json($rows); } }