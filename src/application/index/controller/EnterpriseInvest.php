<?php
 namespace app\index\controller; use app\index\logic\Enterprise; use think\Db; class EnterpriseInvest extends Common { public function joinedFunds($enterprise_id, $investment_id = '', $readonly = 1, $style = '') { goto gWpPG; RDWgB: if (!$investment_id) { goto Wr_KZ; } goto gzXp0; gWpPG: if (!$this->request->isPost()) { goto NETYJ; } goto NCqtP; zfZqD: if (!$style) { goto sPfJs; } goto yI_ee; yI_ee: $tpl .= "\137" . $style; goto kmMHc; NCqtP: $where["\146\x65\x2e\145\156\x74\145\162\160\162\151\163\145\x5f\151\x64"] = $enterprise_id; goto RDWgB; HJxbJ: return json(["\x72\157\x77\163" => $rows]); goto ySA8e; ySA8e: NETYJ: goto wd42W; wd42W: $tpl = "\152\x6f\151\156\x65\x64\x5f\146\165\156\144\x73"; goto zfZqD; gzXp0: $where["\146\145\56\151\156\166\145\163\x74\x6d\x65\156\164\137\x69\144"] = $investment_id; goto e8CoN; fFxgL: $rows = Db::table("\x66\165\156\x64\x73\137\x65\156\164\x65\162\x70\162\x69\x73\x65\x73")->alias("\x66\x65")->join("\146\165\x6e\x64\x73\x20\146", "\x66\56\x66\x75\x6e\x64\137\x69\x64\x3d\x66\145\56\x66\x75\156\144\x5f\151\x64")->join("\x66\x75\x6e\x64\163\137\x66\x69\x6e\x61\x6e\143\x65\137\145\x6e\164\x65\x72\x70\x72\x69\x73\145\163\x20\146\x66\x65", "\x66\x66\145\56\x66\146\x65\137\151\x64\75\146\145\56\x66\x66\145\x5f\151\x64")->field("\146\x65\x2e\52\54\x66\x66\x65\56\141\x6d\157\x75\156\164\x2c\x66\x2e\156\141\155\x65\x2c\146\56\163\151\172\x65")->where($where)->order("\146\145\56\x64\141\x74\145\x5f\144\x65\154\151\x76\x65\162\171\40\x64\x65\163\x63\x2c\146\x65\x2e\151\x64\40\x64\145\x73\x63")->select(); goto HJxbJ; kmMHc: sPfJs: goto Hh1YX; e8CoN: Wr_KZ: goto fFxgL; Hh1YX: return $this->fetch($tpl, ["\145\156\164\x65\162\x70\162\x69\163\x65\137\151\x64" => $enterprise_id, "\x69\156\x76\x65\x73\x74\155\x65\x6e\x74\137\x69\x64" => $investment_id, "\162\145\x61\144\x6f\156\154\x79" => $readonly]); goto gHWeh; gHWeh: } public function investedOverview($enterprise_id) { $this->assign("\165\162\154\163", ["\164\151\x6d\x65\x6c\151\156\x65" => url("\x45\x6e\x74\145\x72\160\162\151\163\145\x49\156\x76\x65\163\164\x2f\164\x69\155\x65\154\151\x6e\x65", ["\x65\156\x74\145\x72\x70\x72\151\x73\x65\137\x69\x64" => $enterprise_id]), "\146\165\x6e\x64\x73" => url("\x45\x6e\x74\145\162\160\x72\151\163\x65\111\156\166\x65\x73\164\x2f\x6a\157\151\x6e\145\x64\x46\165\156\144\163", ["\145\156\x74\145\x72\160\162\x69\x73\x65\x5f\151\x64" => $enterprise_id, "\x73\164\x79\x6c\145" => "\154\151\x67\x68\164"])]); return $this->fetch(); } public function timeline($enterprise_id) { goto kutdv; LvAvz: $time = substr($rows[3], 0, 10); goto ZUwOP; kutdv: $data = []; goto h2gU9; WdeX2: bnnEf: goto go3Ws; SaKbA: $data[] = ["\x6c\x61\x62\x65\x6c" => $time, "\x6e\x61\155\x65" => "\xe7\253\213\351\xa1\xb9", "\x74\151\x6d\145" => $time]; goto mVQtN; Yz5rG: $time = substr($rows[2], 0, 10); goto SaKbA; UMfZv: $data[] = ["\154\141\142\x65\x6c" => $date_delivery, "\156\141\x6d\x65" => "\xe4\272\244\xe5\x89\262", "\164\151\155\145" => $date_delivery]; goto UPvbI; a8DTR: if (!$rows[2]) { goto PUZCQ; } goto Yz5rG; jyY5v: if (!$data) { goto XWI0p; } goto ViIiY; ZUwOP: $data[] = ["\x6c\141\x62\145\x6c" => $time, "\156\x61\155\145" => "\346\212\225\xe5\206\263", "\x74\151\155\x65" => $time]; goto sD6l9; r3qRe: $rows = Db::table("\160\x72\x6f\147\162\x65\163\x73\137\154\157\147\163")->field("\143\x61\164\x65\x67\157\x72\x79\x2c\145\x6e\164\145\x72\145\144\54\x65\156\164\162\171\54\x61\x64\x6d\151\x6e\x5f\151\144")->where(["\145\170\x74\x65\162\156\141\x6c\x5f\151\x64" => $enterprise_id, "\143\141\164\x65\x67\157\x72\x79" => ["\x69\156", "\63\54\65\54\66"], "\x73\x68\157\x77\x5f\x74\151\155\145\154\x69\156\x65" => 1])->order("\x70\162\x6f\147\162\145\x73\x73\x5f\154\x6f\x67\x5f\151\x64\40\x41\x53\103")->select(); goto Cty34; mVQtN: PUZCQ: goto evgak; A7ayJ: foreach ($data as $k => $v) { goto mTvQA; mTvQA: $data[$k]["\x6e\141\x6d\145"] = $k + 1 . "\x2e" . $v["\x6e\141\x6d\x65"]; goto BWF05; YS8hD: $data[$k]["\154\x61\x62\145\154"] = mb_substr($v["\154\x61\142\145\154"], 0, 50) . "\x2e\x2e\56"; goto V_A13; BWF05: $data[$k]["\x64\145\x73\143\162\x69\160\x74\x69\157\x6e"] = $v["\154\x61\142\145\154"]; goto WXLs_; V_A13: K3ZRq: goto dqV00; dqV00: hyE3y: goto aUnsd; WXLs_: if (!(50 < mb_strlen($v["\x6c\x61\x62\x65\154"], "\x75\164\x66\x2d\70"))) { goto K3ZRq; } goto YS8hD; aUnsd: } goto Be7mz; Cty34: if (!$rows) { goto aiWQO; } goto j0jSy; ZzBZg: return $this->fetch(); goto euHEW; h2gU9: $rows = Db::table("\x6d\x65\145\x74\151\156\x67\163")->field("\164\x79\160\x65\x2c\x64\141\164\145\x5f\163\164\x61\x72\164")->where(["\x72\145\x6c\141\x74\145\x5f\x69\144" => $enterprise_id])->order("\151\144\40\104\x45\x53\103")->column("\x64\141\x74\145\x5f\163\x74\x61\x72\x74", "\164\171\x70\145"); goto a8DTR; evgak: if (!$rows[3]) { goto zkPsr; } goto LvAvz; Be7mz: WDBlB: goto IXh0i; UPvbI: g3COr: goto r3qRe; j_5ki: $date_delivery = Db::table("\x66\x75\156\144\163\x5f\x65\x6e\x74\x65\x72\160\162\151\x73\145\163")->where(["\145\x6e\x74\145\162\x70\x72\151\163\x65\x5f\151\144" => $enterprise_id])->order("\151\x64\x20\101\x53\103")->limit(1)->value("\144\x61\x74\x65\137\144\x65\x6c\x69\166\x65\x72\171"); goto fnpRV; fnpRV: if (!$date_delivery) { goto g3COr; } goto UMfZv; IXh0i: $this->assign("\x62\x69\156\x64", ["\143\x68\141\162\164\x5f\x64\141\x74\141" => $data, "\x65\x6e\164\145\162\x70\x72\151\x73\x65" => Enterprise::I()->getEnterprise($enterprise_id)]); goto ZzBZg; sD6l9: zkPsr: goto j_5ki; ViIiY: XWI0p: goto A7ayJ; j0jSy: $admins = \app\index\logic\Admins::I()->getAllUsers(); goto RDu_W; RDu_W: foreach ($rows as $v) { goto GRct2; fyM6u: Txca_: goto M6IGq; GRct2: $time = substr($v["\145\156\x74\145\162\x65\x64"], 0, 10); goto khqCm; khqCm: $data[] = ["\156\141\x6d\x65" => \app\index\logic\ProgressLogs::$progressLogCategoryDefs[$v["\143\x61\x74\x65\147\x6f\x72\x79"]], "\x6c\x61\x62\145\x6c" => substr($v["\145\156\x74\x65\162\x65\x64"], 0, 16) . "\357\274\214" . $admins[$v["\x61\x64\x6d\151\156\137\x69\144"]]["\x72\145\x61\x6c\x6e\x61\155\145"] . "\xef\274\x9a\74\x62\162\x3e" . $v["\145\156\x74\x72\x79"], "\x74\151\x6d\145" => $time]; goto fyM6u; M6IGq: } goto WdeX2; go3Ws: aiWQO: goto jyY5v; euHEW: } }