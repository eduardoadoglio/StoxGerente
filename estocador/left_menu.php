<div class="left-menu">
	<div class="left-menu-item list">
        <i class="fas fa-list"></i>
    </div>

    <div class="left-menu-item add">
        <i class="fas fa-plus"></i>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var pageName = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);
		
		if( pageName == "produtos.php")
			$(".left-menu-item.add").remove();
		else if( pageName == "prateleira.php")
			$(".left-menu-item.add").remove(); // FAZ NO PHP
		else if( pageName == "movimentacoes.php")
			$(".left-menu-item.add").remove();

		$(".left-menu-item.add").on('click', function(){
			if( pageName == "lotes.php")
				location.href = "receber.php";
			else if( pageName == "produtos.php")
				location.href = "receber.php";
			else if( pageName == "prateleira.php")
				location.href = "receber.php";
			else if( pageName == "movimentacoes.php")
				location.href = "receber.php";
		});

		$(".left-menu-item.list").on('click', function(){
			location.href = "lotes.php";
		})
	})
</script>