window.addEvent("domready", function() { 
  
    new iCarousel("list", { 
  
        idPrevious: "prev", 
  
        idNext: "next", 
  
        idToggle: "undefined", 
  
        item: { 
  
            klass: "item", 
  
            size: 86 
  
        }, 
  
        animation: { 
  
            duration: 1000, 
  
            amount: 4 
  
        } 
  
    }); 
  
}); 