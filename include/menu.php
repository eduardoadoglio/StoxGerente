<nav id="upper-menu">
  <div class="mobile-menu">
  <img class="menu-item" id="hamburger" src="images/hamburger.svg"/>
  <span class="mobile-title"> VISÃO GERAL </span>
  <img id="user-image" src="images/max.jpg">
  </div>
  <button class="menu-item" id="empresa">Mercado do Zé</button>
      <!-- INPUT PRA PESQUISA? !-->
      <ul id="user-space">
        <div class="notification"> 3 </div>
        <li> <i class="fas fa-bell"></i> </li>
        <li><img id="user-image" src="images/max.jpg"> </li>
        <li id="user-dropdown">
          <a href="#" class="dropdown-toggle">
            <i class="fas fa-caret-down dropdown-arrow"></i>
          </a>
      <ul class="user-info">
          <li>
              <center>
                <img class="card-image" src="images/max.jpg">
              </center>
            <div class="user-card">
              <span class="card-name">Leonardo Cardoso</span> <br>
              <span class="card-location">
              <i class="fas fa-map-marker-alt card-icon"></i>
              Itanhaém - SP<hr>
              </span>
              <span class="user-options">
                <a class="card-link" href="configs.php"><i class="fas fa-cogs card-icon"></i>Configurações</a> <br>
                <a class="card-link" href="#"><i class="fas fa-bell card-icon"></i>Central de Notificações</a> <br>
                <?php
                if(isset($_COOKIE['nightmode'])){
                  if($_COOKIE['nightmode'] == "true"){
                    echo "<a href='#' class='card-link trigger night-btn nightmode'><i class='far fa-moon card-icon'></i>Desativar Modo Noturno</a>";
                  }
                  else{
                    echo "<a href='#' class='card-link trigger night-btn daymode'><i class='fas fa-moon card-icon'></i>Modo noturno</a>";
                  }
                }
                else{
                  echo "<a href='#' class='card-link trigger night-btn daymode'><i class='fas fa-moon card-icon'></i>Modo noturno</a>";
                }
                ?>
                <br>
                <a class="card-link" href="#"><i class="fas fa-sign-out-alt card-icon"></i>Sair</a>
              </span>
            </div>
          </li>
      </ul>
      </li>
    </ul>
</nav>
