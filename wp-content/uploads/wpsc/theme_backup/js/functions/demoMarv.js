/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


window.onload = function() {
    var s = Snap(900, 600);

    Snap.load(siteURL + "/media/svg/prueba2.svg", function(f) {
        // Note that we traversre and change attr before SVG
        // is even added to the page

        var frente = f.select("#frente path");
        
        
        frente.click(function() {
            var pattern = s.image(siteURL + "/media/svg/patternSuela.jpg", 0, 0, 50, 50)
                    .pattern(0, 0, 50, 50);
            frente.attr("fill", pattern);
//                frente.attr({ stroke: '#123456', 'strokeWidth': 2, fill: 'red', 'opacity': 0.9 });
        });
        frente.hover(function() {
            this.attr('filter', s.filter(Snap.filter.shadow(2, 2, 2, 'black')));
        }, function() {
            this.attr('filter', '');
        });
        
        
        var talon = f.select("#talon path");
        talon.click(function() {
            var pattern = s.image(siteURL + "/media/svg/patternPrincipal.jpg", 0, 0, 50, 50)
                    .pattern(0, 0, 50, 50);
            talon.attr("fill", pattern);
//                frente.attr({ stroke: '#123456', 'strokeWidth': 2, fill: 'red', 'opacity': 0.9 });
        });
        talon.hover(function() {
            this.attr('filter', s.filter(Snap.filter.shadow(2, 2, 2, 'black')));
        }, function() {
            this.attr('filter', '');
        });
        
        
        var cinta = f.select("#cinta path");
        cinta.click(function() {
            var pattern = s.image(siteURL + "/media/svg/patternCintas.jpg", 0, 0, 50, 50)
                    .pattern(0, 0, 50, 50);
            cinta.attr("fill", pattern);
//                frente.attr({ stroke: '#123456', 'strokeWidth': 2, fill: 'red', 'opacity': 0.9 });
        });
        cinta.hover(function() {
            this.attr('filter', s.filter(Snap.filter.shadow(2, 2, 2, 'black')));
        }, function() {
            this.attr('filter', '');
        });
        
        
        var suela = f.select("#suela path");
        suela.click(function() {
            var pattern = s.image(siteURL + "/media/svg/patternLogo.jpg", 0, 0, 50, 50)
                    .pattern(0, 0, 50, 50);
            suela.attr("fill", pattern);
//                frente.attr({ stroke: '#123456', 'strokeWidth': 2, fill: 'red', 'opacity': 0.9 });
        });
        suela.hover(function() {
            this.attr('filter', s.filter(Snap.filter.shadow(2, 2, 2, 'black')));
        }, function() {
            this.attr('filter', '');
        });
        
        
         var orilla = f.select("#orilla_talon path");
        orilla.click(function() {
            var pattern = s.image(siteURL + "/media/svg/patternPrincipal.jpg", 0, 0, 50, 50)
                    .pattern(0, 0, 50, 50);
            orilla.attr("fill", pattern);
//                frente.attr({ stroke: '#123456', 'strokeWidth': 2, fill: 'red', 'opacity': 0.9 });
        });
        orilla.hover(function() {
            this.attr('filter', s.filter(Snap.filter.shadow(2, 2, 2, 'black')));
        }, function() {
            this.attr('filter', '');
        });
        
        
        var placa = f.select("#plaquita_logo path");
        placa.click(function() {
           
              placa.attr({ stroke: '#123456', 'strokeWidth': 1, fill: 'yellow', 'opacity': 0.9 });
        });
        placa.hover(function() {
            this.attr('filter', s.filter(Snap.filter.shadow(2, 2, 2, 'black')));
        }, function() {
            this.attr('filter', '');
        });
        
        
         var ojetes = f.select("#ojetes path");
        ojetes.click(function() {
           
              ojetes.attr({ stroke: '#123456', 'strokeWidth': 1, fill: 'black', 'opacity': 0.9 });
        });
        ojetes.hover(function() {
            this.attr('filter', s.filter(Snap.filter.shadow(2, 2, 2, 'black')));
        }, function() {
            this.attr('filter', '');
        });
        
        s.append(f);
        // Making croc draggable. Go ahead drag it around!

        // Obviously drag could take event handlers too
        // Looks like our croc is made from more than one polygon...
    });
};