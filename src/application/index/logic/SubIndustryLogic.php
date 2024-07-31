<?php
 namespace app\index\logic; use app\index\service\RequestContext; use think\Db; class SubIndustryLogic extends Base { const TABLE = "\x73\165\x62\137\x69\156\x64\x75\163\x74\x72\x79"; public function load($search = array(), $page = 1, $rows = DEFAULT_PAGE_ROWS, $order = "\x69\x64\40\x64\145\163\x63") { goto ZQ58d; CwW_r: return ["\x74\x6f\164\141\x6c" => $count, "\x72\x6f\167\163" => $items]; goto GlYdN; Suf1d: JnlBe: goto HY1Tb; exE7L: $count = Db::table(self::TABLE)->where($where)->count(); goto rl8Vh; M9StS: vjCqL: goto exE7L; o6x6e: return []; goto Suf1d; YIjfV: if (empty($search["\156\141\x6d\x65"])) { goto vjCqL; } goto GFQP4; rl8Vh: if (!empty($count)) { goto JnlBe; } goto o6x6e; GFQP4: $where["\156\x61\155\145"] = ["\154\151\x6b\x65", "\x25" . $search["\156\x61\155\x65"] . "\45"]; goto M9StS; ZQ58d: $where = ["\144\145\x6c\145\x74\x65\x64" => 0]; goto YIjfV; HY1Tb: $items = Db::table(self::TABLE)->where($where)->page($page, $rows)->order($order)->select(); goto CwW_r; GlYdN: } public function getRow($id) { goto wdYAy; QDPsF: qmekX: goto aC7RH; wdYAy: if (!empty($id)) { goto qmekX; } goto m_fl5; e6zwP: return $row; goto hxtNC; m_fl5: return false; goto QDPsF; aC7RH: $row = Db::table(self::TABLE)->where("\151\x64", $id)->find(); goto e6zwP; hxtNC: } public function getDefaultRow() { return ["\156\x61\x6d\x65" => '', "\x64\145\163\x63\x72\151\x70\164\151\157\156" => '', "\151\144" => 0, "\143\x6f\162\145\137\x64\x61\164\x61" => '']; } public function saveRow($id, $data) { goto jHmU2; ZYg91: return $id; goto Mh80y; tsxbN: exception("\xe8\xa1\214\344\xb8\x9a\345\220\x8d\347\247\260\344\270\x8d\350\203\xbd\344\xb8\272\347\xa9\272"); goto sZfD8; rvEfF: $eids = $data["\x65\x6e\164\x65\x72\x70\162\151\x73\145\x73"]; goto wN5im; jHmU2: if (!(isset($data["\x6e\141\x6d\145"]) && empty($data["\x6e\141\x6d\145"]))) { goto OBVv1; } goto tsxbN; EswS5: Db::table(self::TABLE)->where("\x69\x64", $id)->update($data); goto WCkS0; WCkS0: return $id; goto xvdZp; uz0Pt: if (!$eids) { goto cqfLe; } goto Vwf2G; rDpvk: if (!$id) { goto Qe_Tx; } goto EswS5; sZfD8: OBVv1: goto rDpvk; Vwf2G: $this->addEnterprises($id, $eids); goto L631E; wN5im: unset($data["\x65\156\x74\145\x72\160\162\151\x73\x65\x73"]); goto MIZFJ; WecTR: PeCwJ: goto uz0Pt; MIZFJ: $data["\x63\162\145\x61\164\x65\x64\x5f\x62\171"] = RequestContext::I()->loginUserId; goto qP8gV; L631E: cqfLe: goto ZYg91; ZeGS0: if (!empty($id)) { goto PeCwJ; } goto HGVx8; qP8gV: $id = Db::table(self::TABLE)->insert($data, false, true); goto ZeGS0; xvdZp: Qe_Tx: goto rvEfF; HGVx8: exception("\xe6\267\273\345\212\xa0\xe5\xa4\xb1\xe8\xb4\xa5"); goto WecTR; Mh80y: } public function addEnterprises($iid, $eids) { goto S4Wp_; nznb_: foreach ($eids as $eid) { goto RQAi1; Cr_z8: JJ9AO: goto ZWTTH; Pz2gF: goto H47_F; goto Cr_z8; ZWTTH: Db::table("\x73\165\x62\137\151\x6e\144\165\163\x74\162\171\x5f\x65\x6e\164\145\162\x70\162\x69\163\145")->insert(["\x69\151\144" => $iid, "\x65\151\x64" => $eid]); goto h5kJe; RQAi1: if (!Db::table("\x73\165\x62\137\151\x6e\144\165\x73\164\162\x79\x5f\x65\156\164\145\162\x70\162\151\x73\145")->where(["\x69\151\x64" => $iid, "\x65\x69\144" => $eid])->value("\x69\x64")) { goto JJ9AO; } goto Pz2gF; h5kJe: H47_F: goto XNsAV; XNsAV: } goto JoK3Y; JoK3Y: RxtdM: goto l_cjK; S4Wp_: $eids = explode("\54", $eids); goto nznb_; l_cjK: } public function replaceEnterpriseSubIndustry($eid, $iid_old, $iid_new) { goto OAmfm; ZlG81: $this->addEnterprises($iid_new, $eid); goto iAIPT; U5lTm: xIuPn: goto ZlG81; OAmfm: if (!($iid_old && $iid_old != $iid_new)) { goto xIuPn; } goto Mluen; Mluen: Db::table("\163\165\x62\x5f\x69\x6e\144\x75\163\164\x72\171\137\145\156\164\145\x72\x70\x72\151\163\x65")->where(["\x69\x69\x64" => $iid_old, "\145\151\x64" => $eid])->delete(); goto U5lTm; iAIPT: } public function delete($id) { $result = Db::table(self::TABLE)->where("\151\x64", $id)->setField("\x64\x65\154\145\x74\x65\144", 1); return $result > 0 ? true : false; } public function loadChainTreeDatas($subIndustryId, $parentId = 0, $appendNum = false) { goto tsr0b; StlfC: $treeDatas[] = $this->loadChainTreeDataRecursively($subIndustryId, $parentId, $appendNum); goto uenQK; tsr0b: $treeDatas = []; goto StlfC; uenQK: return $treeDatas; goto b52Qi; b52Qi: } protected function loadChainTreeDataRecursively($subIndustryId, $parentId = 0, $appendNum = false) { goto mWSMW; N2_xP: goto Dvobj; goto FX0jv; mc9Gp: $treeNodeDatas = ["\151\x64" => $parentId, "\164\x65\x78\164" => $text, "\x69\143\157\156\x43\x6c\163" => "\146\141\x20\x66\x61\55\x63\x69\162\x63\x6c\145", "\163\164\141\164\145" => "\157\x70\x65\x6e", "\143\x68\151\154\x64\162\145\x6e" => [], "\x65\x6e\x74\x65\x72\160\x72\x69\163\x65\x5f\143\x6f\165\x6e\164" => $memberCount]; goto fRwnY; hxs8K: $treeNodeDatas = ["\151\144" => 0, "\x74\x65\170\x74" => $text, "\151\143\157\156\x43\154\x73" => "\x66\x61\x20\x66\x61\x2d\x63\x68\x61\x69\156", "\163\x74\x61\164\145" => "\x6f\160\x65\x6e", "\x63\x68\151\154\144\x72\x65\156" => [], "\145\156\164\145\x72\x70\162\151\163\x65\x5f\x63\157\x75\x6e\164" => 0]; goto ms_U4; StOQs: a8SLg: goto hxs8K; suyuT: VgtpJ: goto ADSIh; Sdo3I: $text = "\xe4\xba\247\xe4\270\x9a\351\x93\xbe"; goto StOQs; iISS6: return null; goto uwhhp; rI5RQ: $chains = Db::table("\163\x75\x62\137\x69\156\144\x75\163\164\162\171\137\143\x68\141\151\156")->where(["\x73\x75\142\137\151\156\x64\x75\x73\x74\x72\x79\137\151\x64" => $subIndustryId, "\x70\x61\x72\145\156\164\137\151\144" => $parentId])->field("\151\144\54\156\141\x6d\145\x2c\x70\x61\162\145\156\164\137\151\x64")->select(); goto SVua9; jQpma: if (!($nodeText === null)) { goto lwwRR; } goto iISS6; c0qxy: goto a8SLg; goto kcoqI; mWSMW: if ($parentId == 0) { goto WnQXb; } goto KHvP8; uwhhp: lwwRR: goto n9NBz; kcoqI: rZiRD: goto Sdo3I; fRwnY: goto UKcO7; goto hU48W; ms_U4: UKcO7: goto rI5RQ; bdm1Z: $text = "\xe4\272\247\xe4\270\x9a\xe9\x93\xbe"; goto c0qxy; ADSIh: return $treeNodeDatas; goto lU6AR; FX0jv: L0wc1: goto zsIkQ; Eq7O0: if ($appendNum) { goto rZiRD; } goto bdm1Z; jsIse: $text = $nodeText; goto N2_xP; F0mrR: if ($appendNum) { goto L0wc1; } goto jsIse; N1GqM: Dvobj: goto mc9Gp; zsIkQ: $text = $nodeText . "\133" . $memberCount . "\135"; goto N1GqM; hU48W: WnQXb: goto Eq7O0; n9NBz: $memberCount = Db::table("\163\x75\x62\137\x69\156\144\x75\163\164\162\171\x5f\143\150\141\x69\x6e\x5f\x65\156\164\x65\x72\160\x72\x69\163\145")->where("\x73\165\142\137\151\156\x64\165\163\164\162\x79\x5f\x63\150\141\x69\x6e\137\151\144", $parentId)->count(); goto F0mrR; SVua9: foreach ($chains as $key => $chain) { goto QG2OU; ywzbH: K6E7Z: goto zKyG2; sb1iz: $treeNodeDatas["\x63\150\151\x6c\144\162\145\x6e"][] = $childNodeDatas; goto tZSHp; NIeLv: $childNodeDatas = $this->loadChainTreeDataRecursively($subIndustryId, $id, $appendNum); goto mRAjm; QG2OU: $id = (int) $chain["\151\144"]; goto NIeLv; mRAjm: if (!$childNodeDatas) { goto ns5MM; } goto sb1iz; tZSHp: ns5MM: goto ywzbH; zKyG2: } goto suyuT; KHvP8: $nodeText = Db::table("\x73\x75\x62\137\x69\156\144\x75\163\164\162\x79\137\143\x68\141\x69\x6e")->where(["\x73\165\142\137\151\156\144\x75\x73\x74\162\x79\137\151\144" => $subIndustryId, "\151\x64" => $parentId])->value("\x6e\141\155\145"); goto jQpma; lU6AR: } public function addChain($subIndustryId, $name, $parentId) { goto yUSi7; H480C: $result = Db::table("\163\165\x62\137\x69\x6e\144\x75\x73\x74\162\171\137\x63\x68\x61\151\x6e")->insert($data); goto rsOu3; yUSi7: $data = array("\x6e\x61\155\145" => $name, "\x70\141\x72\x65\x6e\x74\x5f\151\x64" => $parentId, "\163\165\x62\137\151\156\x64\165\x73\x74\162\x79\x5f\151\144" => $subIndustryId); goto H480C; rsOu3: return $result != 1 ? false : true; goto YpO75; YpO75: } public function updateChain($subIndustryChainId, $name) { goto Q7vZy; doDud: Db::table("\163\165\x62\x5f\x69\156\144\x75\x73\x74\x72\171\x5f\x63\x68\x61\151\156")->where("\x69\144", $subIndustryChainId)->update($data); goto Y08U3; Q7vZy: $data = array("\x6e\x61\155\145" => $name); goto doDud; Y08U3: return true; goto wLVx6; wLVx6: } public function deleteChain($subIndustryChainId) { goto oBq2K; HDOqK: npcmH: goto WulaZ; r8Smo: if (!Db::table("\x73\x75\142\137\151\x6e\144\x75\163\164\x72\x79\137\143\x68\141\151\x6e")->where("\x70\x61\x72\x65\x6e\x74\137\151\144", $subIndustryChainId)->find()) { goto npcmH; } goto YtTTb; dyhR8: return $result != 1 ? false : true; goto ha4X8; a1cPL: $result = Db::table("\x73\x75\142\137\x69\x6e\x64\x75\163\x74\162\171\x5f\x63\x68\141\151\x6e")->where("\x69\x64", $subIndustryChainId)->delete(); goto dyhR8; YtTTb: return false; goto HDOqK; dtaVw: return false; goto NWOK9; O4qIh: return false; goto ComBR; oBq2K: if (!($subIndustryChainId == 0)) { goto mnKyF; } goto dtaVw; NWOK9: mnKyF: goto r8Smo; ComBR: XFnUu: goto a1cPL; WulaZ: if (!Db::table("\163\165\x62\137\x69\156\x64\165\x73\x74\x72\x79\x5f\143\x68\x61\x69\x6e\137\x65\x6e\x74\145\162\160\x72\151\x73\145")->where("\163\x75\142\137\x69\x6e\x64\x75\x73\164\162\x79\x5f\x63\150\141\151\x6e\137\151\144", $subIndustryChainId)->find()) { goto XFnUu; } goto O4qIh; ha4X8: } }
