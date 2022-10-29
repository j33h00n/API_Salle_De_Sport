function recherche() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("marecherche");
    filter = input.value.toUpperCase();
    table = document.getElementById("matable");
    tr = table.getElementsByTagName("tr");
  
    // Boucle de recherche a travers les lignes de la table,
    // et masque ceux qui ne correspondent pas a la recherche.
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }