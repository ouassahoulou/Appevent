@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">


@section('content')


<div>
    <div class="container">
        <br>
        <h3 align="center">
            <u>{{__("Liste des participant de l'évenement ".$p[0])}}</u> 
         </h3>
         <br>
         <div style="float: left;" class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" style="line-height: 0.5; background-color:#212529; color: white;" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <strong> {{__('Télécharger')}} </strong>
            </button>
         <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a class="dropdown-item" href="{{action('ParticipantController@downloadPDF', $p[0])}}">{{__('Lister les participants (PDF)')}} </a>
            <a class="dropdown-item"  href="{{route('export_par.exportparticipant',$p[0])}}">{{__('Lister les participants (Excel)')}}</a>
            
         </div>
          </div>
         <button type="submit" style="margin: 5px; float: right; line-height: 0.5;" class="btn btn-danger btn-xs delete-all" data-url="">Delete All</button>
         
        
        <table id="data" class="table table-sm">
          <thead>
            
              <tr>
               
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Telephone</th>
                <th scope="col">Email</th>
                <th scope="col">Profession</th>
                <th scope="col">CIN</th>
                <th scope="col">Naissance</th>
                 <th width="15px"><input type="checkbox" id="check_all" ></th>
                {{-- <th class="col">Action</th> --}}
                
              </tr>
            </thead>
           
       <tbody>
              @foreach ($p[1] as $participant)
                <tr id="tr_{{$participant->id}}">
                
                <td>{{$participant->nom}}</td>
                <td>{{$participant->prenom}}</td>
                <td>{{$participant->telephone}}</td>
                <td>{{$participant->email}}</td>
                <td>{{$participant->profession}}</td>
                <td>{{$participant->CIN}}</td>
                <td>{{$participant->naissance}}</td>
                <td><input type="checkbox" class="checkbox" data-id="{{$participant->id}}"></td>
                {{-- <td><a href="{{ Route('part.destroy',$participant->id) }}" 
                  class="deleteProduct"  data-id="{{ $participant->id }}" 
                    data-token="{{ csrf_token() }}" >Delete Task</a>
                </td> --}}
              </tr>
              @endforeach
            </tbody>
 </table>
        <br>
<div class="text-center">
   <a href="{{route('attestation.show',$p[0])}}"> <button type="button" class="submit">{{__('Générer les attestations')}}</button> </a>
</div>
            
            
              
                
          
          {{-- <input type="hidden" name="eve" id="eve" value={{$p}}> --}}
       
    @push('scripts')
    <script type="text/javascript">
        
        $(document).ready(function() {
         var cTable = $('#data').DataTable({
        
        "columns": [
          { "searchable": false, "visible": true, },
      { "searchable": false, "visible": true, },
      { "searchable": false, "visible": true, },
      { "searchable": false, "visible": true, },
      { "searchable": false, "visible": true, },
      { "searchable": true, "visible": true, },
      { "searchable": false, "visible": true, },
      { "searchable": false, "visible": true, },
    ],
    bLengthChange: false,
    searching: true,
    responsive: true,
    "autoWidth": false,
    language: {
      searchPlaceholder: 'Search by CIN ...',
      sSearch: '',
    }
    
  });
});
    </script>
    <script type="text/javascript">
    $(document).ready(function () {

        $('#check_all').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".checkbox").prop('checked', true);  
         } else {  
            $(".checkbox").prop('checked',false);  
         }  
        });

         $('.checkbox').on('click',function(){
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('#check_all').prop('checked',true);
            }else{
                $('#check_all').prop('checked',false);
            }
         });

        $('.delete-all').on('click', function(e) {


            var idsArr = [];  
            $(".checkbox:checked").each(function() {  
                idsArr.push($(this).attr('data-id'));
            });  


            if(idsArr.length <=0)  
            {  
                alert("Please select atleast one record to delete.");  
            }  else {  

                if(confirm("Are you sure, you want to delete the selected categories?")){  

                    var strIds = idsArr.join(","); 

                    $.ajax({
                        url: "{{ Route('part.deleteAll') }}" ,
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+strIds,
                        success: function (data) {
                            if (data['status']==true) {
                                $(".checkbox:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['message']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });


                }  
            }  
        });

        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.closest('form').submit();
            }
        });   
    
    });
</script>
    @endpush
    
    </div>
  
@endsection