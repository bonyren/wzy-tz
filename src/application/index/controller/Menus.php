<?php
 namespace app\index\controller; use app\index\controller\Common; use app\index\logic\Admins; use app\index\logic\Menu; class Menus extends Common { public function index($search = array(), $page = 1, $rows = 20) { goto HEQGp; HEQGp: if (!$this->request->isGet()) { goto jBdi2; } goto PmGpw; PmGpw: $urls = ["\x6c\151\x73\x74" => url("\151\x6e\144\x65\x78\x2f\x4d\145\156\165\163\57\x69\156\x64\x65\170"), "\145\144\x69\x74" => url("\151\x6e\144\x65\x78\x2f\x4d\145\x6e\165\163\x2f\145\x64\151\164"), "\x64\x65\x6c\145\164\145" => url("\x69\x6e\x64\x65\x78\x2f\x4d\145\x6e\x75\163\x2f\144\x65\154\x65\x74\x65")]; goto CoP1D; nE5Q5: Admins::I()->loadLeftMenuRecursively(0, '', $menus); goto EzkJn; PyhWP: return $this->fetch(); goto PIzo6; ixKzS: $menus = []; goto C4WBl; C4WBl: if (!isset($_GET["\163\x68\x6f\x77\x5f\x65\x6d\160\x74\171"])) { goto t8e0k; } goto Cwx1W; CoP1D: $this->assign("\165\x72\x6c\163", $urls); goto PyhWP; zrVko: t8e0k: goto nE5Q5; Cwx1W: $menus[] = ["\151\x64" => 0, "\164\x65\170\x74" => '']; goto zrVko; EzkJn: return json($menus); goto CE_Y4; PIzo6: jBdi2: goto ixKzS; CE_Y4: } public function edit($id = 0, $pid = 0) { goto ZWZYF; ZWBGA: $this->assign("\162\x6f\x77", $row); goto Hu4G8; ixSQS: goto WQ5Fo; goto A7w3k; ZWZYF: if (!$this->request->isPost()) { goto krZST; } goto Ja9XN; RDzaD: $data = $data["\144\141\164\141"]; goto RwbQz; EmCtI: $row["\x70\151\x64"] = intval($pid); goto ixSQS; aLbnD: return $this->fetch(); goto GUHVL; XqN3X: if ($id) { goto DkoKH; } goto EmCtI; Hu4G8: $this->assign("\x74\x72\145\145\x5f\144\141\x74\x61\x5f\x75\x72\x6c", url("\x69\x6e\x64\145\170\57\x4d\x65\156\x75\163\57\151\156\x64\145\x78", "\x73\x68\157\167\x5f\145\x6d\x70\x74\171\75\61")); goto aLbnD; vb4l3: $row = Menu::I()->getRow($id); goto icla2; ojQjf: krZST: goto ysdR1; ysdR1: $row = []; goto XqN3X; RwbQz: try { Menu::I()->save($id, $data); return ajaxSuccess("\344\277\235\345\255\230\xe6\x88\220\xe5\212\237"); } catch (\Exception $e) { return ajaxError($e->getMessage()); } goto ojQjf; A7w3k: DkoKH: goto vb4l3; Ja9XN: $data = input("\x70\x6f\x73\164\56", null, "\164\162\151\155"); goto RDzaD; icla2: WQ5Fo: goto ZWBGA; GUHVL: } public function delete($id) { try { Menu::I()->delete($id); } catch (\Exception $e) { return ajaxError($e->getMessage()); } return ajaxSuccess("\xe5\x88\xa0\xe9\x99\244\346\x88\220\xe5\x8a\237"); } }
