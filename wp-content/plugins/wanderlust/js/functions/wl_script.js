    var logo_id = 0;
    var svg_id = [];
    var pageNode = $("#page_div");
    jQuery(document).ready(function($){
        $("#upload").uploadFile({
                url:ajaxurl+"?action=upload_img",
                multiple:false,
                showStatusAfterSuccess:false,
                fileName:"myfile",
                dragDropStr: "<span><b></b></span>",
                onSuccess: function(v,w,b){
                        obj = JSON.parse(w);
                        var html = '<fieldset class="col_12" id="" data-id="'+ obj.name +'">'+
                                        '<legend>Image <a id="eliminarImagen" style="padding-left: 50px;margin-left: 5px;padding: 2px;margin-bottom: 2px;" class="button"><i class="icon-remove-sign"></i></a></legend>'+
                                        '<div class="col_12"><img class="col_12"src="'+ obj.ret +'"><br />'+
                                    '</fieldset>';

                        $('#imgUpNumeros').prepend(html);
                        $('#paraEsconderNumerosImg').hide();
                },
                showDelete: true,
                deleteCallback: function (data, pd) {
                    for (var i = 0; i < data.length; i++) {
                        $.post("delete.php", {op: "delete",name: data[i]},
                        function (resp,textStatus, jqXHR) {
                            alert("File Deleted");
                        });
                    }
                     pd.statusbar.hide();
                }
        });
/*
        $("body").on("click","#eliminarImagen", function(){

            $("#imgUpNumeros").find('fieldset').remove();
            $('#paraEsconderNumerosImg').show();
        });
*/

        $("body").on("click","#eliminarImagen", function(){
            $(this).closest("fieldset").remove()
            $("#paraEsconderNumerosImg").show();
        });
        $("body").on("click","#eliminarImagenR", function(){
            $(this).closest("fieldset").remove()
            $("#paraEsconderNumerosImgR").show();
        });
        $("body").on("click","#eliminarImagenL", function(){
            $(this).closest("fieldset").remove()
            $("#paraEsconderNumerosImgL").show();
        });
        $("body").on("click","#eliminarImagenH", function(){
            $(this).closest("fieldset").remove()
            $("#paraEsconderNumerosImgH").show();
        });

        $("body").on("click", "#eliminarImagenZapatos", function(){
            $(this).closest("fieldset").find("svg").remove();
            $(this).closest("fieldset").hide();
            $("#paraEsconderNumerosImg").show();
            $("#lateral_derecho").find("fieldset").remove();
            svg_id = [];
        })


        $("#SalvarLogos").click(function(){
            if($("#logo_nombre").val().length > 0){
                params = {};
                params.action = "ProcessLogo";
                params.logo_name = $("#logo_nombre").val();
                params.logo_url  = $("#imgUpNumeros").find("fieldset").data("id");

                if(String($("#logo_nombre").data("id")).length > 0 ){
                    params.logo_id = $("#logo_nombre").data("id");
                }

                $.ajax({
                    type:"POST",
                    url:ajaxurl,
                    data:params,
                    success: function (r){

                        window.location.href="admin.php?page=Logos";
                    },
                    error: function (a,b,c){
                        console.log(a.responseText);
                    },
                    dataType: "json"
                });
            }
            else
            {
                alert("Debe agregar un Nombre");
                return false;
            }
        });

        $("#sliders").uploadFile({
                url:ajaxurl+"?action=upload_img",
                multiple:true,
                showStatusAfterSuccess:false,
                fileName:"myfile",
                dragDropStr: "<span><b></b></span>",
                onSuccess: function(v,w,b){
                        obj = JSON.parse(w);
                        var html = '<fieldset class="col_12" id="" data-id="'+ obj.name +'">'+
                                        '<legend>Image <a id="eliminarImagen" style="padding-left: 50px;margin-left: 5px;padding: 2px;margin-bottom: 2px;" class="button"><i class="icon-remove-sign"></i></a></legend>'+
                                        '<div class="col_12"><img class="col_12"src="'+ obj.ret +'"><br />'+
                                    '</fieldset>';
                        $('#imgUpNumeros').prepend(html);
                        //$('#paraEsconderNumerosImg').hide();
                },
                showDelete: true,
                deleteCallback: function (data, pd) {
                    for (var i = 0; i < data.length; i++) {
                        $.post("delete.php", {op: "delete",name: data[i]},
                        function (resp,textStatus, jqXHR) {
                            alert("File Deleted");
                        });
                    }
                     pd.statusbar.hide();
                }
        });

        $("#SalvarSliders").click(function(){

                params = {};
                params.action   = "ProcessSliders";
                params.urls     = [];
                $("#imgUpNumeros").find("fieldset").each(function(){
                    params.urls.push (($(this).data("id")) );
                });

                $.ajax({
                    type:"POST",
                    url:ajaxurl,
                    data:params,
                    success: function (r){
                        //console.log(r);
                        window.location.href="admin.php?page=Sliders";
                    },
                    error: function (a,b,c){
                        console.log(a.responseText);
                    },
                    dataType: "json"
                });
        });
    $("#telas").uploadFile({
        url:ajaxurl+"?action=upload_img",
        multiple:false,
        showStatusAfterSuccess:false,
        fileName:"myfile",
        dragDropStr: "<span><b></b></span>",
        onSuccess: function(v,w,b){
                obj = JSON.parse(w);
                var html = '<fieldset class="col_12" id="" data-id="'+ obj.name +'">'+
                                '<legend>Image <a id="eliminarImagen" style="padding-left: 50px;margin-left: 5px;padding: 2px;margin-bottom: 2px;" class="button"><i class="icon-remove-sign"></i></a></legend>'+
                                '<div class="col_12"><img class="col_12"src="'+ obj.ret +'"><br />'+
                            '</fieldset>';
                $('#imgUpNumeros').prepend(html);
                $('#paraEsconderNumerosImg').hide();
        },
        showDelete: true,
        deleteCallback: function (data, pd) {
            for (var i = 0; i < data.length; i++) {
                $.post("delete.php", {op: "delete",name: data[i]},
                function (resp,textStatus, jqXHR) {
                    alert("File Deleted");
                });
            }
             pd.statusbar.hide();
        }
    });

    $("#SalvarTelas").click(function(){

        params = {};
        params.action   = "ProcessTelas";
        params.tela_nombre = $("#tela_nombre").val();
        params.urls = [];
        $("#imgUpNumeros").find("fieldset").each(function(){
          params.urls.push($(this).data("id"));
        });
/*
        if(params.urls.length < 4){
          alert("Necesita agregar 4 Telas");
          return false;
        }
*/
        if(String($("#tela_nombre").data("id")).length > 0 ){
            params.tela_id = $("#tela_nombre").data("id");
        }

        $.ajax({
          type:"POST",
          url:ajaxurl,
          data:params,
          success: function (r){
              //console.log(r);
              window.location.href="admin.php?page=Telas";
          },
          error: function (a,b,c){
              console.log(a.responseText);
          },
          dataType: "json"
        });
    });



    $("#zapatos").uploadFile({
        url:ajaxurl+"?action=upload_img",
        multiple:false,
        allowedTypes:"svg",
        showStatusAfterSuccess:false,
        fileName:"myfile",
        dragDropStr: "<span><b></b></span>",
        onSuccess: function(v,w,b){
                obj = JSON.parse(w);
                $.get(obj.ret , null, function(data){
            	    var svgNode = $("svg", data);
            	    var docNode = document.adoptNode(svgNode[0]);
      	          pageNode.html(docNode);
                  pageNode.find("svg").each(function(i){
                      $(this).find("g").each(function(i){
                        if($(this).attr("id")){
                          svg_id.push($(this).attr("id"));
                        }
                     });
                   });
                   load_divs(svg_id);
                },'xml');

                $("#imgUpNumeros_zapatos").find("fieldset").show();
                $("#elZapato").data("id" ,obj.name );
                $('#paraEsconderNumerosImg').hide();
        },
        showDelete: true,
        deleteCallback: function (data, pd) {
            for (var i = 0; i < data.length; i++) {
                $.post("delete.php", {op: "delete",name: data[i]},
                function (resp,textStatus, jqXHR) {
                    alert("File Deleted");
                });
            }
             pd.statusbar.hide();
        }
    });

    $("#SalvarZapato").click(function(){

        params = {};
        params.action   = "ProcessZapatos";
        params.zapato_name  = $("#zapato_nombre").val();
        params.para         = $("#tipo_sexo").val();
        params.orna         = $("#tipo_orna").val();
        params.svg     = $("#elZapato").data("id");
        params.secciones    = svg_id;
/*
        $("#lateral_derecho").find("fieldset").each(function(a , z){
          $(this).find("div").each(function(b , y){
            $(this).find("input[type=radio]:checked").each(function(c , x){
                if($(z).data("name") != "undefined"){
                    params.secciones[a] = $(z).data("name") ;
                    params.secciones.telas[a] = [] ;
                }
                params.secciones.telas[a].push($(x).data("tela"));
            })
          })
        });
        return false;



        params.id_telas_to_use = [];
          $("#lateral_derecho").find("fieldset").each(function(i) {

            $(this).find("input").each(function(i){
                if($(this).is(':checked')){
                    prams.id_telas_to_use.push($(this).data("tela"));
                }
              });
          });
*/
        $.ajax({
            type:"POST",
            url:ajaxurl,
            data:params,
            success: function (r){
                console.log(r);
                window.location.href="admin.php?page=Zapatos";
            },
            error: function (a,b,c){
                console.log(a.responseText);
            },
            dataType: "json"
          });
    });


    function load_divs(data){
      if(data){
        fiel_to_add = "";
        telas = get_telas();
        sec = 0;
        data.forEach(function(i) {
           var hue = 'rgb('
            + (Math.floor(Math.random() * 256)) + ','
            + (Math.floor(Math.random() * 256)) + ','
            + (Math.floor(Math.random() * 256)) + ')';
            $("#"+i).find("path").each(function(j){
              $(this).css("fill", hue)
            })
          fiel_to_add = '<fieldset data-name="'+ i +'" class="col_5" ><legend style="background:'+ hue +'">Tela '+ i +'</legend>';
          telas.forEach(function(tela){
              fiel_to_add += '<div class="col_3">';
              fiel_to_add += '<input type="radio" name="'+tela.id+'_n_'+sec+'" id="'+tela.id+'_v_'+sec+'" class="checkbox" data-pos="v" data-tela="'+tela.id+'" data-seccion="'+i+'" ><label for="'+tela.id+'_v_'+sec+'" class="inline">Vertical</label><br />';
              fiel_to_add += '<input type="radio" name="'+tela.id+'_n_'+sec+'" id="'+tela.id+'_h_'+sec+'" class="checkbox" data-pos="h" data-tela="'+tela.id+'" data-seccion="'+i+'" ><label for="'+tela.id+'_h_'+sec+'" class="inline">Horizontal</label><br />';
              fiel_to_add += '<input type="radio" name="'+tela.id+'_n_'+sec+'" id="'+tela.id+'_r_'+sec+'" class="checkbox" data-pos="r" data-tela="'+tela.id+'" data-seccion="'+i+'" ><label for="'+tela.id+'_r_'+sec+'" class="inline">-45° </label><br />';
              fiel_to_add += '<input type="radio" name="'+tela.id+'_n_'+sec+'" id="'+tela.id+'_l_'+sec+'" class="checkbox" data-pos="l" data-tela="'+tela.id+'" data-seccion="'+i+'" ><label for="'+tela.id+'_l_'+sec+'" class="inline">+45° </label><br />';
              fiel_to_add += '</div>';
          })
          fiel_to_add += "</fieldset>";
          //$("#lateral_derecho").append(fiel_to_add);
          sec++;
        });

      }
    }

    function get_telas(){
      toReturn = "";
      params = {};
      params.action = "ObtenerTelas"
      $.ajax({
        type:"POST",
        url:ajaxurl,
        data:params,
        success: function (r){
          toReturn = r.data;
        },
        error: function (a,b,c){
          console.log(a.responseText)
        },
        dataType:"json",
        async: false
      });
      return toReturn;

    }




  });
