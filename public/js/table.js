$(document).ready(function(){
            $('#myTable').DataTable({
                "order": [[ 7, "desc" ]],
                 lengthMenu: [21, 7, 3 ],
                });
        }); 