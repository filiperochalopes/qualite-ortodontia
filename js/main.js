$(document).ready( function(){

  $('.celular').mask('(00) 00000-0000');
  $('.cpf').mask('000.000.000-00');
  
  if(typeof(get_erro) != "undefined" && get_erro){
    aviso({
      mensagem : get_erro,
      class : "red"
    })
  }

  if(typeof(get_aviso) != "undefined" && get_aviso){
    aviso({
      mensagem : get_aviso,
      class : "yellow"
    })
  }

  function aviso(props, long=false){
  
    time = long ? 50000 : 5000;
  
    if (typeof (timeaviso) !== 'undefined') {
      clearTimeout(timeaviso);
    }

    props = typeof(props) == "object" ? props : JSON.parse(props);
    color = props.class || "grey";
    mensagem = props.mensagem || "Aviso";
    
    $("#aviso").removeClass("red green yellow grey");
    $("#aviso").addClass(color).find("div").html(mensagem);

    $("#aviso").css("display", "inline-table");
    timeaviso = setTimeout(function () { $("#aviso").hide(); }, time);
  }

  $("#aviso .close").click( function(){
    $("#aviso").hide()
  })

  $("#esqueceusenha").click(function (e) {
    e.preventDefault();
    //Verifica email ou usuário
    if ($("#usuarioemail").val() == "") {
      aviso({
        mensagem : "Preencha seu usuário/email para recuperar a senha.",
        class: "red"
      });
      
    }else{
      $.ajax({
        url: "ajax/recuperarsenha.php",
        method: "POST",
        data: { email: $("#email").val() },
        beforeSend: function (xhr) {
          aviso({
            mensagem : "<div class='spinner'><span class='oi oi-reload'></span></div> Carregando...",
            class : "grey"
          });
        }
      }).done(function (data) {
        console.log(data);
        aviso(data);
      });
    }
  });

  /* --------- AUTO CEP ----------- */

  function limpa_formulário_cep() {
    // Limpa valores do formulário de cep.
    $("#auto_rua").val("");
    $("#auto_bairro").val("");
    $("#auto_cidade").val("");
    $("#auto_estado").val("");
  }

  //Quando o campo cep perde o foco.
  $("#auto_cep").blur(function () {

    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

      //Expressão regular para validar o CEP.
      var validacep = /^[0-9]{8}$/;

      console.log(validacep.test(cep));

      //Valida o formato do CEP.
      if (validacep.test(cep)) {

        //Preenche os campos com "..." enquanto consulta webservice.
        $("#auto_rua").focus().val("...");
        $("#auto_bairro").focus().val("...");
        $("#auto_cidade").focus().val("...");
        $("#auto_estado").focus().val("...");

        //Consulta o webservice viacep.com.br/
        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

          if (!("erro" in dados)) {
            //Atualiza os campos com os valores da consulta.
            $("#auto_rua").val(dados.logradouro);
            $("#auto_bairro").val(dados.bairro);
            $("#auto_cidade").val(dados.localidade);
            $("#auto_estado").val(dados.uf);
          } //end if.
          else {
            //CEP pesquisado não foi encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
          }
        });
      } //end if.
      else {
        //cep é inválido.
        limpa_formulário_cep();
        alert("Formato de CEP inválido.");
      }
    } //end if.
    else {
      //cep sem valor, limpa formulário.
      limpa_formulário_cep();
    }
  });

  /* --------- LINKS ----------- */

  $(".link").click(function () {
    window.location.href = $(this).attr("data-link");
  });

  /* --------- NAV ----------- */

  $("#main-menu").click(function () {
    console.log($(this).hasClass("closed"));
    
    if ($(this).hasClass("closed")) {
      $("nav").addClass("show");
      $(this).removeClass("closed");
    } else {
      $("nav").removeClass("show");
      $(this).addClass("closed");
    }
  });

  /* --------- CONFIGURAÇÕES ---------- */

  $("#configemail-bt").click(function () {
    $.ajax({
      url: "ajax/config-email.php",
      method: "POST",
      data: { emailmaster: $("#email").val() },
      beforeSend: function (xhr) {
        aviso({
          mensagem : "<div class='spinner'><span class='oi oi-reload'></span></div> Carregando...",
          class : "grey"
        });
      }
    }).done(function (data) {
      console.log(data);
      aviso(data);
    });
  });

  $("#alterarusuario-bt").click(function () {
    $.ajax({
      url: "ajax/config-usuario.php",
      method: "POST",
      data: { emailmaster: $("#alterarusuario").val() },
      beforeSend: function (xhr) {
        aviso({
          mensagem : "<div class='spinner'><span class='oi oi-reload'></span></div> Carregando...",
          class : "grey"
        });
      }
    }).done(function (data) {
      console.log(data);
      aviso(data);
    });
  });

  $("#form-novasenha").submit(function (e) {
    e.preventDefault();
    if ($("#novasenha").val() == $("#confirmsenha").val()) {

      $.ajax({
        url: "ajax/config-senha.php",
        method: "POST",
        data: { senhaatual: $("#antigasenha").val(), senhanova: $("#novasenha").val() },
        beforeSend: function (xhr) {
          aviso({
            mensagem : "<div class='spinner'><span class='oi oi-reload'></span></div> Carregando...",
            class : "grey"
          });
        }
      }).done(function (data) {
        console.log(data);
        aviso(data);
      });

    } else {
      aviso({
        mensagem : "Senhas digitadas não coincidem.",
        class : "red"
      });
    }
  });

  /* --------- PERFIL ---------- */

  function updateDataPerfil(input){
    id = input.attr("data-id");
    edit = input.attr("data-col");
    val = input.val();

    console.log("info update",id, edit, val);

    $.ajax({
      url: "ajax/perfil-edit.php",
        method: "POST",
        data: {
            id: id,
            edit: edit,
            valor: val
        },
        beforeSend: function( xhr ) {
            var arraydados = $("#form-edit").serializeArray();
            aviso({
              mensagem : "<div class='spinner'><span class='oi oi-reload'></span></div> Carregando...",
              class : "grey"
            });
            $("#backdrop").click();
        }
    }).done(function( data ) {
        console.log(data);
        aviso(data);          
    });
  }

  $("#form-perfil input").blur(function(){
    updateDataPerfil($(this));            
  })

  /* --------- CADASTRO EXTERNO ---------- */

  $("#form-cadastro").submit(function (e) {
    e.preventDefault();    
    if ($("#senha").val() == $("#confirmsenha").val()) {     

      $.ajax({
        url: "ajax/usuarios-novo.php",
        method: "POST",
        data: $("#form-cadastro").serialize(),
        beforeSend: function (xhr) {
          aviso({
            mensagem : "<div class='spinner'><span class='oi oi-reload'></span></div> Carregando...",
            class : "grey"
          });
        }
      }).done(function (data) {
        data = JSON.parse(data);
        aviso(data);
        if(data.link){
          setTimeout( function(){
            window.location = data.link;
          }, 2000);
        }
      });

    } else {
      aviso({
        mensagem : "Senhas digitadas não coincidem.",
        class : "red"
      });
      $("#senha").focus()
    }
  });

  /* --------- CADASTRO INTERNO ---------- */

  $("#form-cadastro-interno").submit(function (e) {
    e.preventDefault();    
    if ($("#senha").val() == $("#confirmsenha").val()) {     

      $.ajax({
        url: "ajax/usuarios-novo-interno.php",
        method: "POST",
        data: $("#form-cadastro-interno").serialize(),
        beforeSend: function (xhr) {
          aviso({
            mensagem : "<div class='spinner'><span class='oi oi-reload'></span></div> Carregando...",
            class : "grey"
          });
        }
      }).done(function (data) {
        data = JSON.parse(data);
        aviso(data);
        if(data.link){
          setTimeout( function(){
            window.location = data.link;
          }, 2000);
        }
      });

    } else {
      aviso({
        mensagem : "Senhas digitadas não coincidem.",
        class : "red"
      });
      $("#senha").focus()
    }
  });

  /* --------- CADASTRO CONVÊNIOS ---------- */

  $("#form-convenio").submit(function (e) {
    e.preventDefault();
      $.ajax({
        url: "ajax/convenios-novo.php",
        method: "POST",
        data: $("#form-convenio").serialize(),
        beforeSend: function (xhr) {
          aviso({
            mensagem : "<div class='spinner'><span class='oi oi-reload'></span></div> Carregando...",
            class : "grey"
          });
        }
      }).done(function (data) {
        data = JSON.parse(data);
        aviso(data);
      });
  });

  /* --------- FILTRO DE MÊS DE ATENDIMENTOS ---------- */

  // Automático

  $("#filtro_atendimentos_mes").change( function(){
    if($(this).val() == "todos"){
      window.location = location.protocol + '//' + location.host + location.pathname;
    }else{
      window.location = location.protocol + '//' + location.host + location.pathname+"?filtro="+$(this).val();
    } 
  })

  // Manual com underline no final

  $("#filtrar_atendimentos").click(function(){
      if($("#filtro_atendimentos_mes_").val() == '0' && $("#dentista_id").val() == ""){
        window.location = location.protocol + '//' + location.host + location.pathname
      }else{
        window.location = location.protocol + '//' + location.host + location.pathname+"?mes="+$("#filtro_atendimentos_mes_").val()+"&dentista="+$("#dentista_id").val();
      }         
  })

  /* --------- FILTRO DE CONVÊNIO DE ATENDIMENTOS ---------- */

  $("#filtro_relatorio_guias_convenio").change(function(){
    if($(this).val() == "todos"){
      window.location = location.protocol + '//' + location.host + location.pathname;
    }else{
      window.location = location.protocol + '//' + location.host + location.pathname+"?filtro="+$(this).val();
    }    
  })

  /* --------- GUIAS NÃO PAGAS ---------- */

  $("#relatorio_guias_pdf").click(function(){
    if($("#filtro_relatorio_guias_convenio").val() != "0"){
      console.log("guia pdf");
    }    
  })

  /* --------- FILTRO DE DENTISTA DE ATENDIMENTOS ---------- */

  $("#filtro_relatorio_guias_dentista_bt").click(function(){
    if($("#filtro_relatorio_guias_dentista").val() == ""){
      window.location = location.protocol + '//' + location.host + location.pathname;
    }else{
      window.location = location.protocol + '//' + location.host + location.pathname+"?filtro="+$("#dentista_id").val();
    }    
  })

  /* --------- CADASTRO NOVO ATENDIMENTO ---------- */

  function validarFormNovoAtendimento() {
    retorno = true;
    console.log(!(!!parseInt($('#atendimento').val())));
    
    if (!(!!parseInt($('#atendimento').val()))) {
      retorno = "Para iniciar o atendimento é necessário selecionar uma opção de atendimento";
      $('#atendimento').addClass('needtofill');
      return retorno;
    }

    return retorno;
  }

  $("#form-novo-atendimento").submit(function (e) {
    e.preventDefault();

    if(validarFormNovoAtendimento() === true){
      $.ajax({
        url: "ajax/atendimento-novo.php",
        method: "POST",
        data: $("#form-novo-atendimento").serialize(),
        beforeSend: function (xhr) {
          aviso({
            mensagem : "<div class='spinner'><span class='oi oi-reload'></span></div> Carregando...",
            class : "grey"
          });
        }
      }).done(function (data) {
        data = JSON.parse(data);
        aviso(data);
        if(data.class=="green"){
          $("#form-novo-atendimento").reset()
        }
      });
    }else{
      aviso({
        mensagem : validarFormNovoAtendimento(),
        class : "red"
      });
    }
  });

  $("#dentista_id").change(function(){
    console.log("oi")
    $.ajax({
      url: "ajax/filtrar-modalidade-atendimento.php",
      method: "GET",
      data: { val : $("#dentista_id").val()},
      beforeSend: function (xhr) {
        aviso({
          mensagem : "<div class='spinner'><span class='oi oi-reload'></span></div> Carregando...",
          class : "grey"
        });
      }
    }).done(function (data) {
      data = JSON.parse(data);
      console.log(data);
      aviso(data);
      if(data.class == "green"){
        // Carrega e libera campos
        $("#atendimento").attr("disabled", false);
        $("#atendimento").text("");
        $("#atendimento").append(`<option value='0' disabled selected>Selecione uma modalidade de atendimento</option>`)
        data.modalidades.forEach( v => {
          $("#atendimento").append(`<option value='${v[0]}'>${v[1]}</option>`)
        })
      }
    });
  })

  $("#atendimento:disabled").click( function(){
    $("#filtro_relatorio_guias_dentista").focus();
  })

  /* --------- INICIAR ATENDIMENTO ---------- */

  // Verificação

  $("#verificar_informacoes").click(function (e) {    
    if(document.getElementById("form-iniciar-atendimento").checkValidity()){
      e.preventDefault();

      $.ajax({
        url: "ajax/verificar-informacoes.php",
        method: "POST",
        data: $("#form-iniciar-atendimento").serialize(),
        beforeSend: function (xhr) {
          aviso({
            mensagem : "<div class='spinner'><span class='oi oi-reload'></span></div> Carregando...",
            class : "grey"
          });
        }
      }).done(function (data) {         
        data = JSON.parse(data);
        console.log(data);
        aviso(data);
        if(data.tipo=="sucesso"){
          $("#iniciar_atendimento_sec").show();
          $("#nomepaciente").html(data.paciente);
          $("#atendimento").html(data.atendimento);
          $("#descricao").html(data.descricao);
          $("#valor").html(data.valor);
        }
      });
    }
  });

  // Envio

  $("#form-iniciar-atendimento").submit(function (e) {
    e.preventDefault();

    $("#selecionar_guia li[data-guia="+$("#guia").val()+"]").hide();

      $.ajax({
        url: "ajax/atendimento-iniciar.php",
        method: "POST",
        data: $("#form-iniciar-atendimento").serialize(),
        beforeSend: function (xhr) {
          aviso({
            mensagem : "<div class='spinner'><span class='oi oi-reload'></span></div> Carregando...",
            class : "grey"
          });
        }
      }).done(function (data) {
        data = JSON.parse(data);
        aviso(data);
        
        if(data.class=="green"){
          document.getElementById("form-iniciar-atendimento").reset();
          $("#iniciar_atendimento_sec").hide();
        }
      });
  });

  // Preenchimento e clique automatico pela seleção em lista

  $("#selecionar_guia").on("click", "li", function(){
    $("#guia").val($(this).attr("data-guia"));
    $("#verificar_informacoes").click();
  })

  /* --------- UPDATE GUIA ---------- */

  $("#form_guia_recebimento_bt").click(function (e) {
    if(document.getElementById("form_guia_recebimento").checkValidity()){
      e.preventDefault();

      $.ajax({
        url: "ajax/guia-recebimento.php",
        method: "POST",
        data: $("#form_guia_recebimento").serialize(),
        beforeSend: function (xhr) {
          aviso({
            mensagem : "<div class='spinner'><span class='oi oi-reload'></span></div> Carregando...",
            class : "grey"
          });
        }
      }).done(function (data) {         
        data = JSON.parse(data);
        console.log(data,);
        aviso(data);
        if(data.class=="green"){
          $("#show_guia_info h4").text(data.dentista);
          $("#show_guia_info p").html(data.texto);
        }
      });
    }
  });

  /* --------- UPDATE REPASSE ---------- */

  $(".repassar").click(function (e) {
    id = $(this).attr("data-id");
    valor = $(this).attr("data-valor");

      $.ajax({
        url: "ajax/guia-repasse.php",
        method: "POST",
        data: {
          id: id,
          valor: valor
        },
        beforeSend: function (xhr) {
          aviso({
            mensagem : "<div class='spinner'><span class='oi oi-reload'></span></div> Carregando...",
            class : "grey"
          });
        }
      }).done(function (data) {         
        // data = JSON.parse(data);
        console.log(data);
        // aviso(data);
      });
  });

  /* --------- HINTS ---------- */

  $("#paciente").keyup(function (e) {
    e.preventDefault();
    var hintBox = "pacientes-hint";

      $.ajax({
        url: "ajax/hint/pacientes.php",
        method: "GET",
        data: { "nome" : $(this).val() },
      }).done(function (data) {
        $("#"+hintBox+" ul").html("");    
        data = JSON.parse(data);
        if(data.length){
          $("#"+hintBox).show();
          data.forEach( function(element, index, array){
            $("#"+hintBox+" ul").append("<li>"+element+"</li>");
          })
        }else{
          $("#"+hintBox).hide();
          $("#"+hintBox+" ul").html("");
        }        
        console.log(data);
      });
  });

  $("#filtro_relatorio_guias_dentista").keyup(function (e) {
    e.preventDefault();
    var hintBox = "dentistas-hint";

      $.ajax({
        url: "ajax/hint/dentistas.php",
        method: "GET",
        data: { "nome" : $(this).val() },
      }).done(function (data) {
        $("#"+hintBox+" ul").html("");    
        data = JSON.parse(data);
        if(data.length){
          $("#"+hintBox).show();
          data.forEach( function(element, index, array){
            $("#"+hintBox+" ul").append("<li data-usuario='"+element[1]+"'>"+element[0]+"</li>");
          })
        }else{
          $("#"+hintBox).hide();
          $("#"+hintBox+" ul").html("");
        }        
        console.log(data);
      });
  });

  $(".form-control").focus( function(){
    if(!$(this).hasClass("hint-input")){
      closehint($(this).attr("id"), $(this).val());
    }
  })

  $(".form-control.hint").on("click", "li", function(){
    var input_id = $(this).parent().parent().attr("data-input-hint"),
    value = $(this).text().trim();

    //hack para filtro do relatório por dentistas
    if(input_id == "filtro_relatorio_guias_dentista"){
      var dentista_id = $(this).attr("data-usuario");
      $("#dentista_id").val(dentista_id).change();
    }
    
    closehint(input_id, value);
  })

  function closehint(id, value){
    $("#"+id).val(value);
    $(".form-control.hint").hide();
  }

  /* --------- AUTORIZAÇÃO ---------- */

  function updateValidacao(id_usuario, opcao){
    $.ajax({
      url: "ajax/usuarios-validacao.php",
      method: "POST",
      data: {
        "id-usuario" : id_usuario,
        "opcao" : opcao },
      beforeSend: function (xhr) {
        aviso({
          mensagem : "<div class='spinner'><span class='oi oi-reload'></span></div> Carregando...",
          class : "grey"
        });
      }
    }).done(function (data) {
      data = JSON.parse(data);
      console.log(data);      
      aviso(data);
      
      $( "#wrap-validacao-cadastro" ).load( "validacao-cadastro-tables.php" );
    });
  }

  // Pendentes de autorização

  $("#wrap-validacao-cadastro").on("click", "#table-usuarios-pendentes .opcoes", function(){
    id_usuario = $(this).attr("data-id-usuario");
    opcao = Boolean(parseInt($(this).attr("data-opcao")));
    updateValidacao(id_usuario, opcao); 
  })

  // Lista de cadastros

  $("#wrap-validacao-cadastro").on("click", "#table-usuarios .opcoes", function(){
    id_usuario = $(this).attr("data-id-usuario");
    opcao = Boolean(parseInt($(this).attr("data-opcao")));
    updateValidacao(id_usuario, opcao);
  })

  // Cadastros rejeitados

  $("#wrap-validacao-cadastro").on("click", "#table-usuarios-rejeitados .opcoes", function(){
    id_usuario = $(this).attr("data-id-usuario");
    opcao = Boolean(parseInt($(this).attr("data-opcao")));
    updateValidacao(id_usuario, opcao); 
  })

})