
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- style -->
    <link rel="stylesheet" href="css/style.css">
    <title>Api-Correios</title>
</head>
<body>
    <header>
        <h1 class="flex-center">Consumo de Api dos correios</h1>
    </header>

    <main>
        <section>
            <h2>Consultar cep</h2>
            <div class="row flex-center">
                <div class="box padding-2 flex-center">
                    <form name="form1" id="form1">
                        <input type="text" name="cep" id="cep">
                        <input type="submit" value="Validar" class="btn">
                        <!-- A linha abaixo é usada para trazer a resposta -->
                        <span id="response"></span>
                    </form>
                </div>
            </div>

        </section>
    </main>
  
    <!-- scripts -->
    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#form1").submit(function(e){
                e.preventDefault();

                if( $("#cep").val() == ""){
                    alert("Informe o cep a ser pesquisado");
                    return false;
                }else if($("#cep").val().length < 8){
                    $("#response").html("O cep deve conter oito digitos");
                    return;
                }
                $.ajax({
                    url: "validar.php",
                    type: "POST",
                    data: {cep: $("#cep").val()},
                    dataType: "html",
                    beforeSend: function(){
                        $("#response").html('Processando...');
                    },
                    success: function(data,status)
                    {
                        if(data != "error" && data != "- "){
                            $("#response").html(data);
                            $("#cep").val('');
                            return;
                        }else if(data == "- "){
                            $("#response").html('Cep não encontrado');
                            $("#cep").val("");
                            return;
                        }

                        alert("Campo cep inválido digite apenas números");
                        $("#response").html("");

                    },
                    error: function()
                    {
                        alert("error")
                    }
                });

                return false;
            });              
        });
    </script>
</body>
</html>