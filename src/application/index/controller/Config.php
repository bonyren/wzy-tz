<?php
 namespace app\index\controller; use app\index\logic\Enterprise; use app\index\logic\Extra; use app\index\logic\Meeting; use app\index\logic\Tag; use think\Controller; use think\Db; use think\Log; use think\Debug; use think\Request; use app\index\logic\ConfigLogic; use app\index\model\Dropdowns; class Config extends Common { public function index() { goto HTMO7; Myx91: $this->assign("\165\162\154\110\162\x65\146\163", $urlHrefs); goto ew_9G; ew_9G: return $this->fetch(); goto RphTm; HTMO7: $urlHrefs = ["\142\x75\x73\151\x6e\145\x73\163\122\x65\x67\x50\x72\157\x78\171" => url("\x69\156\144\x65\170\x2f\x43\157\x6e\x66\x69\147\57\x69\156\144\x65\x78\102\165\x73\151\x6e\145\163\163\122\x65\x67\120\x72\157\x78\x79"), "\x66\165\156\x64\x48\x6f\163\164\151\x6e\x67\101\x67\x65\x6e\143\x79" => url("\x69\x6e\x64\x65\170\x2f\103\157\x6e\146\x69\x67\x2f\151\x6e\x64\x65\x78\x46\x75\156\144\x48\157\x73\164\151\x6e\x67\x41\x67\x65\x6e\x63\x79"), "\x64\162\x6f\160\x64\157\167\156\x73" => url("\143\157\x6e\146\151\147\57\x64\x72\x6f\160\x64\x6f\167\x6e\163"), "\x6d\x65\x65\164\151\x6e\147\x73" => url("\x63\157\156\146\151\x67\x2f\155\145\145\x74\151\x6e\147\163")]; goto Myx91; RphTm: } public function indexBusinessRegProxy($search = array(), $page = 1, $rows = DEFAULT_PAGE_ROWS, $sort = "\151\x64", $order = "\144\145\163\x63") { goto J_Kvn; wpYd2: XGojh: goto XpgY8; LtDTL: $this->assign("\144\141\164\x61\147\162\x69\144", $datagrid); goto VD733; jEJeP: return json($configLogic->loadBusinessRegProxys($search, $page, $rows, $sort, $order)); goto ik3DP; J_Kvn: if (!request()->isGet()) { goto XGojh; } goto b_8Gg; yRh1_: $datagrid = array("\157\160\x74\x69\157\x6e\x73" => array("\x74\151\x74\x6c\x65" => '', "\165\x72\x6c" => url("\151\156\x64\x65\x78\x2f\x43\x6f\x6e\146\151\147\x2f\151\x6e\144\x65\x78\x42\x75\163\151\x6e\145\x73\163\x52\145\x67\x50\x72\x6f\x78\x79", array("\x67\162\x69\144" => "\x64\141\164\141\147\162\x69\x64")), "\164\157\157\154\142\141\162" => "\x62\165\x73\151\156\145\163\163\x52\145\x67\x50\x72\157\x78\x79\115\157\144\x75\154\x65\x2e\x74\157\x6f\x6c\x62\x61\x72", "\x66\151\x74\x43\157\x6c\x75\155\x6e\163" => $this->loginMobile ? false : true), "\x66\x69\x65\154\x64\x73" => array("\x49\104" => array("\x66\151\x65\154\144" => "\151\x64", "\x77\151\144\x74\150" => 100, "\163\157\162\164\141\x62\154\145" => false), "\345\220\215\347\xa7\xb0" => array("\x66\151\x65\154\x64" => "\x6e\141\155\145", "\x77\151\x64\164\150" => 200, "\163\157\x72\x74\x61\142\x6c\145" => false), "\xe8\x81\224\xe7\xb3\273\344\272\272" => array("\x66\x69\145\154\144" => "\x6c\151\x6e\153\x6d\141\x6e", "\167\x69\144\164\x68" => 100, "\163\157\x72\164\141\x62\154\145" => false), "\347\x94\xb5\xe8\257\235" => array("\146\151\145\154\x64" => "\164\145\x6c", "\x77\x69\x64\164\x68" => 100, "\163\x6f\162\164\x61\142\154\x65" => false), "\xe6\267\273\345\x8a\xa0\xe6\227\xb6\351\x97\xb4" => array("\146\151\x65\x6c\144" => "\x65\156\x74\145\162\145\144", "\167\151\144\164\150" => 100, "\163\157\x72\x74\x61\x62\x6c\x65" => false), "\xe6\x93\x8d\344\275\234" => array("\x66\151\145\x6c\x64" => "\x6f\x70\164", "\167\151\x64\164\150" => 100, "\163\157\162\x74\x61\x62\x6c\145" => false, "\x66\157\x72\x6d\x61\x74\x74\145\162" => "\x62\165\x73\151\156\145\163\163\x52\145\147\x50\162\157\x78\x79\x4d\157\x64\x75\x6c\x65\56\157\x70\x65\x72\141\164\145"))); goto LtDTL; b_8Gg: $urlHrefs = ["\x61\x64\144" => url("\151\x6e\144\x65\170\57\x43\157\156\x66\x69\147\x2f\x61\x64\144\102\x75\x73\x69\156\145\x73\x73\122\145\147\x50\162\x6f\x78\171"), "\x65\x64\x69\x74" => url("\151\x6e\x64\x65\170\x2f\x43\x6f\156\146\151\147\x2f\x65\144\x69\164\102\x75\163\x69\x6e\x65\163\163\x52\145\147\x50\x72\x6f\x78\x79"), "\144\145\x6c\145\x74\145" => url("\x69\156\x64\x65\x78\x2f\103\x6f\156\146\151\x67\57\x64\145\x6c\145\164\x65\x42\x75\x73\151\x6e\x65\x73\163\x52\145\147\x50\162\x6f\170\171")]; goto RRZsl; VD733: return $this->fetch(); goto wpYd2; RRZsl: $this->assign("\x75\x72\154\x48\162\145\146\x73", $urlHrefs); goto yRh1_; XpgY8: $configLogic = ConfigLogic::newObj(); goto jEJeP; ik3DP: } public function getBusinessRegProxyComboConfig() { $configLogic = ConfigLogic::newObj(); return json($configLogic->loadBusinessRegProxyComboDatas()); } public function addBusinessRegProxy() { goto rIFh3; dezrK: $urlHrefs = []; goto o3nEB; rIFh3: if (!request()->isGet()) { goto GxCaO; } goto dezrK; MbLPm: $infos = input("\x70\157\x73\x74\x2e\151\156\146\157\163\57\x61"); goto MWM4Y; z_JQ4: goto bGaHa; goto LInJ8; Si2HS: return $this->fetch(); goto D3wjz; JenNX: $result = $configLogic->addBusinessRegProxy($infos); goto RCW8q; wM2wY: bGaHa: goto C0Vm5; o3nEB: $this->assign("\165\x72\154\x48\162\x65\146\163", $urlHrefs); goto Si2HS; MWM4Y: $configLogic = ConfigLogic::newObj(); goto JenNX; RCW8q: if ($result) { goto fnDzd; } goto EHYXL; D3wjz: GxCaO: goto MbLPm; LInJ8: fnDzd: goto RAIuv; RAIuv: return ajaxSuccess("\xe6\x88\x90\xe5\212\x9f"); goto wM2wY; EHYXL: return ajaxError("\xe5\244\xb1\xe8\264\xa5"); goto z_JQ4; C0Vm5: } public function editBusinessRegProxy($id) { goto x906O; o0vwK: if ($result) { goto ssmQH; } goto z0Y1h; z0Y1h: return ajaxError("\345\244\xb1\350\xb4\xa5"); goto qB95w; hPVUY: ssmQH: goto IzlXg; IzlXg: return ajaxSuccess("\346\210\220\xe5\212\237"); goto B1Lp_; qB95w: goto oUZxU; goto hPVUY; Frm8n: return $this->fetch(); goto nBCr1; F4TgQ: if (!request()->isGet()) { goto vQjoT; } goto dD5As; lCRh0: $result = $configLogic->editBusinessRegProxy($id, $infos); goto o0vwK; XCWp8: $this->assign("\x62\x69\156\144\x56\141\154\x75\x65\x73", $bindValues); goto Frm8n; uNKbS: if ($infos) { goto C1yl9; } goto kwQJd; gi4oW: $infos = input("\160\x6f\163\164\56\151\x6e\146\x6f\163\x2f\141"); goto lCRh0; aWBtb: C1yl9: goto ZlFHe; ZlFHe: $bindValues = ["\x69\x6e\146\x6f\163" => $infos]; goto XCWp8; dD5As: $infos = $configLogic->getBusinessRegProxyInfos($id); goto uNKbS; kwQJd: return $this->fetch("\143\157\x6d\x6d\x6f\x6e\x2f\145\x72\162\157\x72"); goto aWBtb; B1Lp_: oUZxU: goto F8j5t; x906O: $configLogic = ConfigLogic::newObj(); goto F4TgQ; nBCr1: vQjoT: goto gi4oW; F8j5t: } public function deleteBusinessRegProxy($id) { goto FjBjR; ChaJB: nF0w7: goto T0rbz; NCF7q: if ($result) { goto YeFnc; } goto xcE9H; Md_Mb: YeFnc: goto szvZx; FjBjR: $result = ConfigLogic::newObj()->deleteBusinessRegProxy($id); goto NCF7q; xcE9H: return ajaxError("\xe5\244\261\xe8\xb4\245"); goto gr4pv; gr4pv: goto nF0w7; goto Md_Mb; szvZx: return ajaxSuccess("\346\x88\x90\345\x8a\x9f"); goto ChaJB; T0rbz: } public function indexFundHostingAgency($search = array(), $page = 1, $rows = DEFAULT_PAGE_ROWS, $sort = "\x69\144", $order = "\144\145\x73\x63") { goto WwJUG; D4BI5: $datagrid = array("\157\160\x74\x69\157\x6e\x73" => array("\164\151\164\154\x65" => '', "\165\162\x6c" => url("\x69\156\x64\x65\170\x2f\103\157\156\146\x69\147\x2f\151\156\x64\145\x78\106\165\156\144\x48\157\x73\x74\151\x6e\147\x41\x67\x65\156\x63\x79", array("\147\162\x69\x64" => "\144\x61\x74\x61\147\162\x69\x64")), "\164\x6f\157\154\142\x61\162" => "\146\x75\x6e\x64\x48\157\x73\164\x69\x6e\147\x41\x67\145\x6e\x63\171\115\157\144\x75\x6c\x65\56\x74\157\x6f\154\x62\141\x72", "\146\x69\164\x43\157\154\165\155\x6e\x73" => $this->loginMobile ? false : true), "\146\x69\145\154\x64\x73" => array("\x49\104" => array("\x66\x69\x65\154\x64" => "\151\x64", "\167\x69\144\x74\x68" => 100, "\163\157\x72\164\141\x62\x6c\145" => false), "\345\220\x8d\xe7\xa7\xb0" => array("\x66\x69\145\154\144" => "\156\x61\155\x65", "\167\151\144\x74\x68" => 100, "\163\157\162\x74\x61\x62\154\145" => false), "\350\201\x94\347\xb3\273\344\272\xba" => array("\x66\151\x65\x6c\x64" => "\154\x69\156\x6b\x6d\141\x6e", "\x77\151\144\164\150" => 100, "\x73\x6f\x72\x74\x61\x62\154\x65" => false), "\347\224\265\xe8\xaf\235" => array("\146\x69\145\154\144" => "\164\145\154", "\167\151\x64\164\150" => 50, "\x73\x6f\162\164\141\142\x6c\x65" => false), "\xe6\xb7\xbb\345\212\xa0\xe6\227\266\351\x97\xb4" => array("\x66\151\x65\x6c\x64" => "\145\156\x74\145\162\145\144", "\x77\151\144\164\150" => 100, "\x73\157\x72\x74\141\x62\x6c\x65" => false), "\xe6\x93\215\344\275\x9c" => array("\x66\151\145\154\144" => "\x6f\x70\164", "\x77\151\x64\164\x68" => 100, "\x73\157\x72\164\141\142\x6c\x65" => false, "\146\157\x72\x6d\x61\x74\x74\x65\x72" => "\146\165\156\x64\110\x6f\x73\164\x69\156\x67\x41\147\145\x6e\143\x79\115\x6f\144\165\x6c\x65\56\x6f\x70\x65\162\x61\164\x65"))); goto LA81F; lGPQs: VbDKO: goto NIlRh; NIlRh: $configLogic = ConfigLogic::newObj(); goto IyZBS; LA81F: $this->assign("\144\141\164\x61\x67\x72\x69\144", $datagrid); goto cx11r; WwJUG: if (!request()->isGet()) { goto VbDKO; } goto QeD72; IyZBS: return json($configLogic->loadFundHostingAgencies($search, $page, $rows, $sort, $order)); goto UlAJF; Z0kA5: $this->assign("\x75\162\x6c\x48\162\x65\x66\163", $urlHrefs); goto D4BI5; cx11r: return $this->fetch(); goto lGPQs; QeD72: $urlHrefs = ["\x61\x64\x64" => url("\x69\x6e\x64\x65\x78\x2f\103\157\156\x66\151\147\x2f\x61\144\144\x46\x75\156\144\x48\157\163\164\x69\x6e\147\101\147\145\x6e\143\x79"), "\x65\144\151\x74" => url("\151\x6e\x64\145\x78\x2f\x43\x6f\x6e\146\151\x67\57\x65\144\x69\x74\x46\x75\156\x64\110\157\163\164\151\156\147\101\x67\145\156\x63\171"), "\144\145\x6c\x65\x74\145" => url("\x69\x6e\144\145\170\57\103\157\156\146\x69\147\57\144\145\x6c\145\164\x65\106\x75\x6e\144\x48\x6f\163\164\x69\156\x67\101\x67\145\156\143\x79")]; goto Z0kA5; UlAJF: } public function getFundHostingAgencyComboConfig() { $configLogic = ConfigLogic::newObj(); return json($configLogic->loadFundHostingAgencyComboDatas()); } public function addFundHostingAgency() { goto JTK5n; Z6JwY: rwHdh: goto hE37L; wuU7y: if ($result) { goto AguuT; } goto H2hES; HRzSc: AguuT: goto r9sOF; JTK5n: if (!request()->isGet()) { goto pOYvy; } goto N6wUh; r9sOF: return ajaxSuccess("\xe6\x88\220\xe5\x8a\237"); goto Z6JwY; N6wUh: $urlHrefs = []; goto Qzizw; qsMeL: goto rwHdh; goto HRzSc; kFMDw: $configLogic = ConfigLogic::newObj(); goto xEjp8; iuin0: $infos = input("\x70\157\163\x74\56\x69\x6e\x66\x6f\163\57\x61"); goto kFMDw; c0t_P: pOYvy: goto iuin0; GtJ_7: return $this->fetch(); goto c0t_P; Qzizw: $this->assign("\x75\x72\154\110\x72\145\x66\163", $urlHrefs); goto GtJ_7; H2hES: return ajaxError("\xe5\xa4\xb1\350\264\245"); goto qsMeL; xEjp8: $result = $configLogic->addFundHostingAgency($infos); goto wuU7y; hE37L: } public function editFundHostingAgency($id) { goto xQWC8; hof23: $result = $configLogic->editFundHostingAgency($id, $infos); goto QBPhc; QBPhc: if ($result) { goto tYB56; } goto f3OdI; WBwz2: $bindValues = ["\x69\156\146\157\x73" => $infos]; goto ImosJ; OFZ9x: if (!request()->isGet()) { goto XOLMf; } goto VglZJ; ImosJ: $this->assign("\x62\x69\x6e\x64\x56\141\x6c\165\x65\163", $bindValues); goto BzSU7; WK3UX: XOLMf: goto wvmCB; VglZJ: $infos = $configLogic->getFundHostingAgencyInfos($id); goto GhJqF; GhJqF: if ($infos) { goto mOF4Y; } goto Ca_Nf; Ca_Nf: return $this->fetch("\143\157\x6d\x6d\x6f\x6e\x2f\145\162\162\157\x72"); goto ei8f_; Rt1hy: tYB56: goto EAe3Y; BzSU7: return $this->fetch(); goto WK3UX; f3OdI: return ajaxError("\345\244\261\xe8\264\245"); goto rgdZb; xQWC8: $configLogic = ConfigLogic::newObj(); goto OFZ9x; rgdZb: goto Y2fkz; goto Rt1hy; wvmCB: $infos = input("\160\157\163\164\x2e\151\x6e\x66\157\163\57\x61"); goto hof23; ewX6I: Y2fkz: goto OpbVT; EAe3Y: return ajaxSuccess("\xe6\210\x90\345\212\x9f"); goto ewX6I; ei8f_: mOF4Y: goto WBwz2; OpbVT: } public function deleteFundHostingAgency($id) { goto shBgt; hVzem: goto EP8N0; goto w9D0T; w9D0T: pdPZv: goto EYCgH; shBgt: $result = ConfigLogic::newObj()->deleteFundHostingAgency($id); goto rW90p; rW90p: if ($result) { goto pdPZv; } goto CyL63; EYCgH: return ajaxSuccess("\346\x88\x90\345\x8a\237"); goto Ddkuf; CyL63: return ajaxError("\345\244\261\xe8\264\245"); goto hVzem; Ddkuf: EP8N0: goto BoTKz; BoTKz: } public function dropdowns($search = array(), $page = 1, $rows = DEFAULT_PAGE_ROWS) { goto ewitk; Zh68S: return json([]); goto yGv4l; il29S: if (!empty($rows)) { goto fu_ib; } goto Zh68S; f8FAq: $where = []; goto LftGG; sh2LH: return $this->fetch(); goto aviGz; LftGG: $rows = db("\144\x72\x6f\160\x64\157\x77\x6e\x73")->where($where)->page($page, $rows)->select(); goto il29S; yGv4l: fu_ib: goto pUP1P; pUP1P: $total = db("\x64\x72\x6f\160\144\x6f\167\156\x73")->where($where)->count(); goto L9FhY; ewitk: if (!$this->request->isGet()) { goto ixpGL; } goto sh2LH; aviGz: ixpGL: goto f8FAq; L9FhY: return json(["\164\157\164\x61\x6c" => $total, "\162\157\167\163" => $rows]); goto xS6Cw; xS6Cw: } public function editDropdown($id = 0) { goto Bt2EP; MTVSE: W5q0o: goto LHy3V; fDBuE: if (!$this->request->isGet()) { goto jJRo5; } goto Vl9Oq; lxchX: waLaR: goto a0gv0; wTPj8: $row = $model::get($id)->toArray(); goto lxchX; dFo8B: goto waLaR; goto ruN60; fQ04J: jJRo5: goto JILuj; ruN60: mJnQg: goto wTPj8; igPwC: return ajaxSuccess("\344\277\x9d\345\255\x98\xe6\210\x90\345\212\x9f"); goto qX5Vw; Vl9Oq: if ($id) { goto mJnQg; } goto MgfqL; LHy3V: return $this->fetch('', ["\x72\x6f\x77" => $row]); goto fQ04J; v5b1V: $row["\151\x74\x65\x6d\163"] = [[]]; goto MTVSE; Bt2EP: $model = new Dropdowns(); goto fDBuE; MgfqL: $row = []; goto dFo8B; a0gv0: if (!empty($row["\151\x74\x65\155\163"])) { goto W5q0o; } goto v5b1V; JILuj: try { $model->saveDropdown($id, $_POST); } catch (\Exception $e) { return ajaxError($e->getMessage()); } goto igPwC; qX5Vw: } public function deleteDropdown($id) { Dropdowns::destroy($id); return ajaxSuccess("\xe5\x88\xa0\351\x99\244\xe6\210\x90\xe5\x8a\237"); } public function industries() { goto pDJyq; pDJyq: if (!$this->request->isGet()) { goto bUq5v; } goto WVfvh; NfpUJ: return json(array_values($rows)); goto qdCYq; c6R1X: $rows = Enterprise::I()->treeIndustries(); goto NfpUJ; WVfvh: return $this->fetch(); goto xU8iP; xU8iP: bUq5v: goto c6R1X; qdCYq: } public function editIndustry($id = 0, $pid = 0) { goto FNzz0; qBCe1: $data = input("\x70\157\x73\x74\56"); goto YsdLT; g2vk7: $childs = Db::table("\164\x61\147\163")->where("\160\151\x64", $id)->count(); goto kZANF; LljVP: return $this->fetch(); goto d31R7; XoIkT: goto wkuGx; goto hua52; Kanwm: $this->assign("\160\x61\162\145\156\164\x73", Enterprise::I()->treeIndustries()); goto LljVP; HrMOt: if ($data["\x70\151\x64"]) { goto AR7s7; } goto Rz1ko; Zf9V7: ZSi04: goto SjEfF; tmcvC: C3A2w: goto WWmmI; XRmZF: $data["\143\x61\x74\x65\x67\157\162\171"] = Tag::TAG_INDUSTRY; goto HrMOt; HpZjw: $parent = Db::table("\x74\141\x67\163")->where("\x69\144", $data["\160\x69\144"])->find(); goto i7TE1; FNzz0: if (!$this->request->isGet()) { goto MBqzg; } goto kNw_3; H8SJS: wkuGx: goto trm_l; YsdLT: $data = $data["\x64\x61\x74\x61"]; goto XRmZF; hhwKx: $row = Db::table("\x74\x61\147\163")->where("\151\144", $id)->find(); goto H8SJS; WWmmI: try { goto OCm_U; dSbup: Db::table("\x74\x61\x67\163")->where("\151\x64", $id)->update($data); goto ZUv6r; oOHug: goto ANee8; goto IL5lR; ZUv6r: ANee8: goto HGQmC; IL5lR: pKq4H: goto dSbup; NqDGh: Db::table("\164\x61\x67\x73")->insert($data); goto oOHug; HGQmC: return ajaxSuccess("\344\277\235\345\xad\230\xe6\210\x90\345\x8a\x9f"); goto rlI0W; OCm_U: if ($id) { goto pKq4H; } goto NqDGh; rlI0W: } catch (\Exception $e) { return ajaxError($e->getMessage()); } goto EWGyx; CHQhe: $row["\160\x69\x64"] = intval($pid); goto XoIkT; trm_l: $this->assign("\x72\x6f\167", $row); goto Kanwm; SjEfF: JLH5S: goto tmcvC; hua52: QBncJ: goto hhwKx; kZANF: if (!$childs) { goto ZSi04; } goto bFZuS; kNw_3: $row = []; goto RArXH; Rz1ko: goto C3A2w; goto NVvyA; d31R7: MBqzg: goto qBCe1; NVvyA: AR7s7: goto HpZjw; bFZuS: return ajaxError("\350\257\267\345\205\x88\347\xa7\273\xe5\207\272\xe4\270\213\xe7\272\xa7\xe6\225\xb0\xe6\215\256"); goto Zf9V7; RArXH: if ($id) { goto QBncJ; } goto CHQhe; i7TE1: if (!$id) { goto JLH5S; } goto g2vk7; EWGyx: } public function delIndustry($id) { Db::table("\164\x61\147\x73")->where("\x69\144\x3d{$id}\40\157\x72\x20\160\x69\x64\x3d{$id}")->delete(); return ajaxSuccess("\345\210\xa0\xe9\231\xa4\xe6\210\220\xe5\x8a\237"); } public function indexScientistField($search = array(), $page = 1, $rows = DEFAULT_PAGE_ROWS, $sort = "\x69\144", $order = "\x64\x65\x73\x63") { goto zS751; sdcIf: $datagrid = array("\157\x70\x74\x69\x6f\156\x73" => array("\164\x69\164\x6c\x65" => '', "\x75\162\154" => url("\151\156\x64\145\x78\x2f\x43\x6f\x6e\x66\x69\147\x2f\151\x6e\144\145\x78\123\x63\151\145\x6e\x74\x69\163\164\106\151\x65\x6c\x64", array("\147\162\x69\x64" => "\144\141\164\x61\147\x72\151\144")), "\x74\x6f\x6f\154\x62\141\x72" => "\x73\x63\151\x65\156\164\151\x73\164\x46\151\145\154\144\115\157\x64\x75\154\x65\56\164\157\x6f\x6c\142\x61\162", "\146\151\x74\103\x6f\154\x75\155\156\163" => $this->loginMobile ? false : true), "\x66\x69\145\x6c\x64\x73" => array("\x49\104" => array("\x66\x69\x65\x6c\x64" => "\x69\x64", "\x77\x69\144\164\150" => 100, "\163\157\162\164\141\x62\154\145" => false), "\345\220\x8d\347\xa7\260" => array("\x66\151\145\154\144" => "\x6e\x61\155\145", "\x77\x69\144\x74\x68" => 100, "\163\157\162\x74\141\x62\x6c\x65" => false), "\xe6\267\xbb\345\212\240\xe6\x97\xb6\351\x97\264" => array("\146\151\x65\x6c\x64" => "\x65\x6e\164\145\162\x65\144", "\167\151\x64\164\x68" => 100, "\x73\x6f\x72\x74\x61\142\x6c\x65" => false), "\346\x93\215\xe4\xbd\234" => array("\146\151\x65\154\x64" => "\x6f\160\x74", "\x77\x69\144\x74\150" => 100, "\x73\157\x72\x74\x61\142\154\145" => false, "\x66\157\162\155\141\164\164\145\x72" => "\x73\x63\x69\145\156\164\151\x73\164\106\151\x65\x6c\x64\115\x6f\144\x75\x6c\145\56\157\160\145\162\141\164\x65"))); goto G62Ms; XhWGn: $urlHrefs = ["\x73\x61\166\x65" => url("\x69\156\x64\x65\x78\57\103\157\156\x66\151\147\57\x73\x61\166\145\x53\143\151\145\x6e\x74\x69\x73\164\106\x69\x65\x6c\144"), "\x64\145\x6c\x65\x74\145" => url("\x69\156\x64\x65\170\x2f\x43\x6f\x6e\x66\151\147\x2f\144\x65\x6c\145\164\145\x53\143\x69\x65\156\x74\x69\163\164\106\151\x65\x6c\x64")]; goto Oqibg; gHSTw: uhqew: goto J668F; sydTx: return json($configLogic->loadScientistFields($search, $page, $rows, $sort, $order)); goto Dxa12; Kxd_y: return $this->fetch(); goto gHSTw; Oqibg: $this->assign("\165\162\154\110\162\145\146\x73", $urlHrefs); goto sdcIf; J668F: $configLogic = ConfigLogic::newObj(); goto sydTx; G62Ms: $this->assign("\144\141\164\x61\147\162\x69\x64", $datagrid); goto Kxd_y; zS751: if (!request()->isGet()) { goto uhqew; } goto XhWGn; Dxa12: } public function getScientistFieldComboConfig() { $configLogic = ConfigLogic::newObj(); return json($configLogic->loadScientistFieldComboDatas()); } public function saveScientistField($id = 0) { goto DYH6B; DYH6B: $configLogic = ConfigLogic::newObj(); goto Dk9ac; w9O0Y: qN1Dl: goto DXuQW; m2o6g: $infos = input("\x70\x6f\163\164\56\x69\x6e\146\x6f\163\x2f\x61"); goto bWYK6; Dk9ac: if (!request()->isGet()) { goto ckyO2; } goto O1BPf; lV4ar: return $this->fetch("\143\x6f\x6d\x6d\157\x6e\57\x65\162\x72\x6f\162"); goto U66Z0; ciqcr: sDhAz: goto Jc_j6; O1BPf: if ($id) { goto TUuOm; } goto VQcUv; bWYK6: $result = $configLogic->saveScientistField($id, $infos); goto y3r4N; VQcUv: $infos = ["\x6e\141\x6d\x65" => '']; goto Ion4n; qd7i6: ckyO2: goto m2o6g; DE7Qc: return ajaxSuccess("\346\x88\x90\345\212\x9f"); goto w9O0Y; irvpJ: TUuOm: goto egT7A; e4xJo: if ($infos) { goto fi9Qr; } goto lV4ar; Jc_j6: $this->assign("\x69\156\x66\x6f\x73", $infos); goto ltBIw; kVNqf: ye5rl: goto DE7Qc; Ion4n: goto sDhAz; goto irvpJ; iRxN6: return ajaxError("\xe5\244\xb1\350\264\245"); goto gk7oA; y3r4N: if ($result) { goto ye5rl; } goto iRxN6; U66Z0: fi9Qr: goto ciqcr; egT7A: $infos = $configLogic->getScientistFieldInfos($id); goto e4xJo; ltBIw: return $this->fetch(); goto qd7i6; gk7oA: goto qN1Dl; goto kVNqf; DXuQW: } public function deleteScientistField($id) { goto ObLW4; B64Ux: if ($result) { goto qYU8N; } goto n2Xoc; cb57J: return ajaxSuccess("\xe6\210\x90\345\x8a\x9f"); goto frTRh; ZJjLd: goto xaqgy; goto itnse; ObLW4: $result = ConfigLogic::newObj()->deleteScientistField($id); goto B64Ux; n2Xoc: return ajaxError("\345\244\xb1\350\264\xa5"); goto ZJjLd; itnse: qYU8N: goto cb57J; frTRh: xaqgy: goto W9OHl; W9OHl: } }
