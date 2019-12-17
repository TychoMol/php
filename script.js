function acdelete(delid) {
    if (confirm("Wilt u uw account verwijderen?")){
        window.location.href='./includes/delete.inc.php?delid='+delid+'';
        return true;
    }
}

