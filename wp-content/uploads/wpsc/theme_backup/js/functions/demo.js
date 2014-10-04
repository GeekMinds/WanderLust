/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


    window.onload = function () {
        	var s = Snap(900, 600);

Snap.load(siteURL+"/media/svg/demoShoe.svg", function (f) {
    // Note that we traversre and change attr before SVG
    // is even added to the page
    
    var suela = f.select("#suela");
    
    suela.click(function(){
        var pattern = s.image(siteURL+"/media/svg/patternSuela.jpg",0,0,50,50)
        .pattern(0,0,50,50);
        suela.attr("fill", pattern);
    });
     suela.hover(function(){
         this.attr('filter', s.filter(Snap.filter.shadow(2, 2, 2, 'black')));
     }, function(){
         this.attr('filter', '');
     });
    
     
   
    s.append(f);
    // Making croc draggable. Go ahead drag it around!
    
    // Obviously drag could take event handlers too
    // Looks like our croc is made from more than one polygon...
});
  };