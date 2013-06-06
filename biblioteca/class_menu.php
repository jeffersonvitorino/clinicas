<?php
error_reporting(E_ALL ^ E_NOTICE);

class Menu {
	
	public function montarMenuNiveis($tipo_menu, $id_usuario_nivel){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
		
		$acaoUsuarioArea = new usuario_area();
		$acaoMenu        = new Menu();
		
		if ($tipo_menu == "V") // Vertical
			$sentido_menu = 'id="smoothmenu2" class="ddsmoothmenu-v"';
		elseif ($tipo_menu == "H") // Horizontal
			$sentido_menu = 'id="smoothmenu1" class="ddsmoothmenu"';
		
		$menu = '
				<div ' . $sentido_menu . ' > 
					<ul>
				';
				
		$exeListarUsuarioAreaPorIdNivel = $acaoUsuarioArea -> listarUsuarioAreaPorIdNivel($id_usuario_nivel);
		while ($infListarUsuarioAreaPorIdNivel = mysql_fetch_array($exeListarUsuarioAreaPorIdNivel)) {
			
			$contaSubMenu = $acaoUsuarioArea -> contarUsuarioAreaTotalDeSubItens($id_usuario_nivel, $infListarUsuarioAreaPorIdNivel["id_usuario_area"]);
			
			if (($infListarUsuarioAreaPorIdNivel["area_id"] == 0) and ($contaSubMenu == 0)) {
			
				$menu .= $acaoMenu -> montarMenuSemSubNiveis($infListarUsuarioAreaPorIdNivel["caminho"], $infListarUsuarioAreaPorIdNivel["descricao"]);
		
			} elseif (($infListarUsuarioAreaPorIdNivel["area_id"] == 0) and ($contaSubMenu != 0)) {
			
				$menu .= $acaoMenu -> montarMenuComSubNiveis($id_usuario_nivel, $infListarUsuarioAreaPorIdNivel["id_usuario_area"], $infListarUsuarioAreaPorIdNivel["descricao"]);
			
			}
		
		}
		
		$menu .= '
					</ul>
				</div>
				';

		return $menu;
	}
	
	public function montarMenuSemSubNiveis($caminho, $descricao){
		
		$item_menu = '<li><a href="?area=' . base64_encode($caminho) . '">' . $descricao . '</a></li>';

		return $item_menu;
	}
	
	public function montarMenuComSubNiveis($id_usuario_nivel, $id_usuario_area, $descricao){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
		
		$acaoUsuarioArea = new usuario_area();
		$acaoMenu        = new Menu();
	
		$item_menu = '
					 <li><a href="#">' . $descricao . '</a>
						 <ul>
					 ';
				
		$exeListarUsuarioAreaPorAreaIdeIdNivel = $acaoUsuarioArea -> listarUsuarioAreaPorAreaIdeIdNivel($id_usuario_nivel, $id_usuario_area);
		while ($infListarUsuarioAreaPorAreaIdeIdNivel = mysql_fetch_array($exeListarUsuarioAreaPorAreaIdeIdNivel)) {
				
			$contaSubMenu = $acaoUsuarioArea -> contarUsuarioAreaTotalDeSubItens($id_usuario_nivel, $infListarUsuarioAreaPorAreaIdeIdNivel["id_usuario_area"]);
			
			if ($contaSubMenu == 0) {
				
				$item_menu .= $acaoMenu -> montarMenuSemSubNiveis($infListarUsuarioAreaPorAreaIdeIdNivel["caminho"], $infListarUsuarioAreaPorAreaIdeIdNivel["descricao"]);
		
			} elseif ($contaSubMenu != 0) {
			
				$item_menu .= $acaoMenu -> montarMenuComSubNiveis($id_usuario_nivel, $infListarUsuarioAreaPorAreaIdeIdNivel["id_usuario_area"], $infListarUsuarioAreaPorAreaIdeIdNivel["descricao"]);
			
			}
		
		}

		$item_menu .= '
						  </ul>
					  </li>
					  ';
		
		return $item_menu;
	}

	public function montarMenu($id_usuario_nivel){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
		
		$acaoUsuarioArea = new usuario_area();
		$acaoMenu        = new Menu();
	
		$menu = '
				<div id="menu">
					<ul class="tabs">
				';
				
		$exeListarUsuarioAreaPorIdNivel = $acaoUsuarioArea -> listarUsuarioAreaPorIdNivel($id_usuario_nivel);
		while ($infListarUsuarioAreaPorIdNivel = mysql_fetch_array($exeListarUsuarioAreaPorIdNivel)) {
			
			$contaSubMenu = $acaoUsuarioArea -> contarUsuarioAreaTotalDeSubItens($id_usuario_nivel, $infListarUsuarioAreaPorIdNivel["id_usuario_area"]);
			
			if (($infListarUsuarioAreaPorIdNivel["area_id"] == 0) and ($contaSubMenu == 0)) {
			
				$menu .= $acaoMenu -> montarMenuSemSub($infListarUsuarioAreaPorIdNivel["caminho"], $infListarUsuarioAreaPorIdNivel["descricao"]);
		
			} elseif (($infListarUsuarioAreaPorIdNivel["area_id"] == 0) and ($contaSubMenu != 0)) {
			
				$menu .= $acaoMenu -> montarMenuComSUb($id_usuario_nivel, $infListarUsuarioAreaPorIdNivel["id_usuario_area"], $infListarUsuarioAreaPorIdNivel["descricao"]);
			
			}
		
		}
		
		$menu .= '
					</ul>
				</div>
				';

		return $menu;
	}
	
	public function montarMenuSemSub($caminho, $descricao){
		
		$item_menu = '<li><a href="?area=' . base64_encode($caminho) . '">' . $descricao . '</a></li>';

		return $item_menu;
	}
	
	public function montarMenuComSUb($id_usuario_nivel, $id_usuario_area, $descricao){
		$mySQL = new MySQL;
		$mySQL->connMySQL();
		
		$acaoUsuarioArea = new usuario_area();
		$acaoMenu        = new Menu();
	
		$item_menu = '
					 <li class="hasmore"><span><a href="#">' . $descricao . '</a></span>
						 <ul class="dropdown">
					 ';
				
		$exeListarUsuarioAreaPorAreaIdeIdNivel = $acaoUsuarioArea -> listarUsuarioAreaPorAreaIdeIdNivel($id_usuario_nivel, $id_usuario_area);
		while ($infListarUsuarioAreaPorAreaIdeIdNivel = mysql_fetch_array($exeListarUsuarioAreaPorAreaIdeIdNivel)) {
			
			$item_menu .= $acaoMenu -> montarMenuSemSub($infListarUsuarioAreaPorAreaIdeIdNivel["caminho"], $infListarUsuarioAreaPorAreaIdeIdNivel["descricao"]);
		
		}

		$item_menu .= '
						  </ul>
					  </li>
					  ';
		
		return $item_menu;
	}

}
?>