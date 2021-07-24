$(document).ready(()=>{

    //Variavel criada para armazenar os estados e cidades, para que não seja necessário duas consultas a API
    let estadosCidades;

    let sts;

    //Adiciona o plugin a tabela de listagem de clientes
    $('#tableClientes').DataTable();  

    //Obter todos os estados e cidades do brasil 
    $.get("https://gist.githubusercontent.com/letanure/3012978/raw/2e43be5f86eef95b915c1c804ccc86dc9790a50a/estados-cidades.json",(data)=>{
        
        let selEstados = document.getElementById( 'inputEstado' );

        estadosCidades = JSON.parse(data);

        estadosCidades.estados.forEach( function( estado ){

            //Cria elemento option
            let opt = document.createElement("option");
            
            //Adiciona nome do estado
            opt.innerHTML = estado.nome;

            //Adiciona ao value do option a sigla do estado
            opt.value = estado.sigla
            
            //Adiciona opção no select
            selEstados.appendChild(opt);
    
        });

    });

    //Evento de CHANGE ao elemento de seleção de estado, adicionando ao SELECT cidades todas as cidades daquele estado
    $("#inputEstado").on("change",(e)=>{

        //Sigla do estado selecionado
        let estadoSelecionado = $("#inputEstado").val();

        //Elemento SELECT cidade
        let selCidades = document.getElementById( 'inputCidade' );

        //Limpando todas as options do SELECT
        selCidades.innerHTML = ' ';

        estadosCidades.estados.forEach( function( estado ){

            if(estado.sigla == estadoSelecionado){
                
                estado.cidades.forEach(function(cidade){

                    /// ;  cria elemento option de cidade
                    let opt = document.createElement("option");
        
                    /// ; adiciona nome da cidade
                    opt.innerHTML = cidade
        
                    opt.value = cidade
                    
                    /// ; adiciona opção no select
                    selCidades.appendChild(opt);

                });//Fim forEach da lista de cidades
                
            }//Fim da verificação do estado selecionado

        });//Fim forEach da lista de estados

        //Remoção do atributo disabled, para que seja possivel escolher uma cidade
        selCidades.removeAttribute("disabled")
    });

    //Time out para remover alerta em caso de erro ou sucesso na criação de cliente
    if($(".alert").length){
        setTimeout(() => {
            $(".alert").fadeOut();
        }, 2000);
    };

    //Verificação dos campos de estado e cidade
    $('#botaoEnviar').on("click",(e)=>{
      
        if($("#inputEstado").val() == '0' || $("#inputCidade").val() == '0' ){
            e.preventDefault();
            alert("Selecione um Estado!");
        } 
        if($(".invalido").length){
            e.preventDefault();
            alert("O CPF digitado já está cadastrado");
        }
        
    });

    //Verifica se o CPF digitado já esta cadastrado
    $("#inputCpf").on("blur",()=>{

        let cpf = $('#inputCpf').val();
        $.get("/verificarCpf?cpf="+cpf,(data)=>{
            if(data=="1"){
                alert("O CPF digitado já está cadastrado")
                $('#inputCpf').removeClass("valido");
                $('#inputCpf').addClass("invalido");
            }else{
                $('#inputCpf').removeClass("invalido");
                $('#inputCpf').addClass("valido");
            }
        })

    })

    //Verificação dos campos de edição de estado e cidade
    $('#botaoAtualizarCliente').on("click",(e)=>{
        if($("#inputEstadoEdit").val() == '0' || $("#inputCidadeEdit").val() == '0'){
            e.preventDefault();
            alert("Selecione um Estado!");
        }
    });
    
});


//Obtem os dados para a edição do cliente
function editarCliente(cpfCliente){
    $.get("/getCustomerData?cpf="+cpfCliente,(data)=>{
        $("#editarCliente .modal-body").html(data)
    })
}

//Remove o cliente
function removerCliente(cpfCliente){

    var r = confirm("Tem certeza que deseja remover este cliente?");
    if(r){
        $.post("/removerCliente",{cpf:cpfCliente},(data)=>{
            if(data){
                alert("Cliente removido com sucesso!")
                window.location.href="/"
            }else{
                alert("Erro ao remover cliente")
            }
        })
    }
    
}
