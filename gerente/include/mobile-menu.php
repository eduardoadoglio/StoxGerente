<nav class="side-mobile">
  <i id="close-btn" class="fas fa-times"></i>
  <img id="user-img" src="images/max.jpg">
  <div class="user-card">
    <span class="card-name">Leonardo Cardoso</span> <br>
    <span class="card-location">
    <i class="fas fa-map-marker-alt card-icon"></i>
    Itanhaém - SP
    </span>
    <hr class="side-separator">
    <span class="side-caption"> Páginas </span>
    <span class="user-options">
      <a class="card-link" href="index.php"><i class="fas fa-chart-line card-icon"></i>Visão Geral</a> <br>
      <a class="card-link" href="funcionarios.php"><i class="fas fa-users card-icon"></i>Funcionarios</a> <br>
      <a class="card-link" href="lotes.php"><i class="fas fa-list card-icon"></i>Lotes</a> <br>
      <a class="card-link" href="movimentacoes.php"><i class="fas fa-dolly card-icon"></i>Movimentações</a> <br>
    </span>
    <hr class="side-separator">
    <span class="side-caption"> Suas Preferências </span>
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
</nav>
