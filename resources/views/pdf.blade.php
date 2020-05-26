
<html>
    <head>
      <meta charset="utf-8">
      <title></title>
    </head>
    <body>
<div>
    <div class="container">
        <br><br> <br>
        <h1 align="center">
            <strong>Liste des participant de l'évenement: "</strong> 
         </h1>
         <br><br> 
         
        
        <table width="100%" style="border-collapse: collapse; border: 1px;"  >
          <thead>
            <tr>
                <th style="border: 1px solid; padding:2px;" width="12%"  scope="col">Nom</th>
                <th style="border: 1px solid; padding:2px;" width="12%" scope="col">Prenom</th>
                <th  style="border: 1px solid; padding:2px;" width="12%" scope="col">Telephone</th>
                <th  style="border: 1px solid; padding:2px;" width="12%" scope="col">Email</th>
               
                <th  style="border: 1px solid; padding:2px;" width="12%" scope="col">CIN</th>
                <th style="border: 1px solid; padding:18px;" width="12%" scope="col"> Naissance </th>
                <th style="border: 1px solid; padding:2px;" width="5px" scope="col">Absence</th>
                
               
                
              </tr>
            </thead>
           
       <tbody>
        @foreach ($participant as $participant)
                <tr>
                <td style="border: 1px solid; padding:2px;" >{{$participant->nom}}</td>
                <td style="border: 1px solid; padding:2px;" >{{$participant->prenom}}</td>
                <td style="border: 1px solid; padding:2px;" >{{$participant->telephone}}</td>
                <td style="border: 1px solid; padding:2px;">{{$participant->email}}</td>
               
                <td style="border: 1px solid; padding:2px;" >{{$participant->CIN}}</td>
                <td style="border: 1px solid; padding:2px;" >{{$participant->naissance}}</td>
                <td style="border: 1px solid; padding:2px;"> </td>
              @endforeach 
            </tbody>
 </table >

</body></html>
