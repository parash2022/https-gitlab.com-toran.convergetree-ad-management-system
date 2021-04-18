<tr> 
   
    <td>&nbsp;&nbsp;&nbsp;&nbsp; —— {{$grandchildren->name}}</td>  
    <td>
       <a href="{{route('administrator.terms.edit',[$taxonomy->slug,$grandchildren->id])}}">Edit</a> | 
        <a href="{{route('administrator.terms.delete',[$taxonomy->slug,$grandchildren->id])}}" class="delete-data">Delete</a>
        <form class="d-none" method="post" action="{{route('administrator.terms.delete',[$taxonomy->slug,$grandchildren->id])}}">
            @csrf
        </form>
    </td>
</tr>