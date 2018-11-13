
<?php $file = basename($_SERVER['SCRIPT_NAME'], '.php');?>
<nav class="menu" id="menu">
    <a class="menu-item <?php if($file=='lotes' || $file=='receber' || $file == 'cadastrarlote') echo 'active'; ?>" href="lotes.php"><span><i class="fas fa-boxes"></i>Lotes</span></a>
    <a class="menu-item <?php if($file=='produtos') echo 'active'; ?>" href="produtos.php"><span><i class="fas fa-shopping-bag"></i>Produtos</span></a>
    <a class="menu-item <?php if($file=='prateleira') echo 'active'; ?>" href="prateleira.php"><span><i class="fas fa-shopping-cart"></i>Prateleira</span></a>
    <a class="menu-item <?php if($file=='movimentacoes') echo 'active'; ?>" href="movimentacoes.php"><span><i class="fas fa-dolly"></i>Movimentações</span></a>
    <a class="menu-item <?php if($file=='notificacoes') echo 'active'; ?>" href="notificacoes.php"><span><i class="fas fa-bell"></i>Notificações</span></a>
</nav>

<script type="text/javascript">
	// Isso faz com que o menu-item ativo esteja no foco do menu
	var menu 	 = document.getElementById("menu");
	var menuItem = document.getElementsByClassName("active");
	var scrollX  = menuItem[0].offsetLeft;
	menu.scrollTo(scrollX - 120, 0);
</script>
