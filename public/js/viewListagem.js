$(function(){
    var timeLoad;
    $('#filtro input').keyup(function(){
        clearTimeout(timeLoad);
        timeLoad = setTimeout(function() {
            listarProdutos(true);
        }, 500);
    });
});

function listarProdutos(filtro = false) {
    $.ajax({
        type: 'POST',
        url: 'Produtos/Lista/Json',
        dataType: 'JSON',
        cache: false,
        async: false,
        data: {
            filtros: filtro,
            idProduto: $('#filtroId').val(),
            nomeProduto: $('#filtroNome').val(),
            descricaoProduto: $('#filtroDescricao').val(),
            valorProduto: $('#filtroValor').val(),
            quantidadeProduto: $('#filtroQuantidade').val()
        },
        success: function(result){
            var cont = result.length;
            var html = '';
            for (var x = 0; x < cont; x++) {
                html += '<tr class="remover">';
                html += '   <td class="text-center">' + result[x].idProduto + '</td>';
                html += '   <td>' + result[x].nomeProduto + '</td>';
                html += '   <td>' + result[x].descricaoProduto + '</td>';
                html += '   <td>' + result[x].valorProduto + '</td>';
                html += '   <td>' + result[x].quantidadeProduto + '</td>';
                html += '   <td>';
                html += '       <a class="btn btn-default" href="Produtos/Detalhe?idProduto=' + result[x].idProduto + '">';
                html += '           <span class="glyphicon glyphicon-search"></span>';
                html += '       </a>';
                html += '       <span class="btn btn-default glyphicon glyphicon-pencil" onClick="editarProduto(' + result[x].idProduto + ');"></span>';
                html += '       <span class="btn btn-default glyphicon glyphicon-remove" onClick="removerProduto(' + result[x].idProduto + ');"></span>'
                html += '   </td>';
                html += '</tr>';
            }
            $('.remover').remove();
            $('#listagem').append(html);
        }

    });
}

function editarProduto(idProduto){
    $.ajax({
        type: 'POST',
        url: 'Produtos/Detalhe/Json',
        dataType: 'JSON',
        cache: false,
        async: false,
        data: {
            idProduto: idProduto
        },
        success: function(result){
            $('#modalProdutoEditar #nomeProduto').val(result.nomeProduto);
            $('#modalProdutoEditar #descricaoProduto').val(result.descricaoProduto);
            $('#modalProdutoEditar #valorProduto').val(result.valorProduto);
            $('#modalProdutoEditar #quantidadeProduto').val(result.quantidadeProduto);
            $('#modalProdutoEditar').modal('show');
        }
    });
}

function removerProduto(idProduto) {
    $.ajax({
        type: 'POST',
        url: 'Produtos/Remove',
        dataType: 'JSON',
        cache: false,
        async: false,
        data: {
            idProduto: idProduto
        },
        success: function(result){
            if (result.success === true) {
                alert('Produto deletado com sucesso');
                listarProdutos(true);
            }
        }
    });
}

function novoProduto(){
    $.ajax({
        type: 'POST',
        url: 'Produtos/Novo',
        dataType: 'JSON',
        cache: false,
        async: false,
        data: $('#formProdutoNovo').serialize(),
        success: function(result){
            if (result.success === true) {
                alert('Contato Adicionado com sucesso!');
                $('#formProdutoNovo input').val('');
                $('#modalProdutoNovo').modal('hide');
                listarProdutos(true);
            }
        }
    });
}

listarProdutos();