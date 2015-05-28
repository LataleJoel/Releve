function confirmationSuppression(id) {
   if (confirm("Etes vous-sûr de vouloir supprimer cette epreuve?")) { // Clic sur OK
	   window.location="index.php?controller=releves&action=supprimer&id="+id;
   }
   else{
		window.location="index.php?controller=releves&action=lister";
   }
}