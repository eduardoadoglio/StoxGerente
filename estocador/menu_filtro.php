<?php $file = basename($_SERVER['SCRIPT_NAME'], '.php'); ?>

<div class="filter-menu">
    <?php 
        if($file == 'lotes')
        {
        	echo '<span class="filter" data-checked="unchecked" data-filter="nome"><i class="far fa-square"></i>Nome</span>';
            echo '<span class="filter" data-checked="unchecked" data-filter="validade"><i class="far fa-square"></i>Validade</span>';
            echo '<span class="filter" data-checked="unchecked" data-filter="quantidade"><i class="far fa-square"></i>Quantidade</span>'; 
        }
        else if($file == 'prateleira')
        {
        	echo '<span class="filter" data-checked="unchecked" data-filter="nome"><i class="far fa-square"></i>Nome</span>';
            echo '<span class="filter" data-checked="unchecked" data-filter="quantidade"><i class="far fa-square"></i>Quantidade</span>'; 
        }
        else if($file == 'produtos')
        {
        	echo '<span class="filter" data-checked="unchecked" data-filter="nome"><i class="far fa-square"></i>Nome</span>';
        }
        else if($file == 'movimentacoes' || $file == 'notificacoes')
        {
        	echo '<span class="filter" data-checked="unchecked" data-filter="quantidade"><i class="far fa-square"></i>Data</span>';
        }
    ?>

   <div id="order-selector" class="up"><i class="fas fa-long-arrow-alt-up"></i></div>
</div>