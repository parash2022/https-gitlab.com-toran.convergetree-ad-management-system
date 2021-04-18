<tr> 
    
    <td>{{$parent->name}}</td>
    <td>
       <a href="{{route('administrator.terms.edit',[$taxonomy->slug,$parent->id])}}">Edit</a> | 
        <a href="{{route('administrator.terms.delete',[$taxonomy->slug,$parent->id])}}" class="delete-data">Delete</a>
        <form class="d-none" method="post" action="{{route('administrator.terms.delete',[$taxonomy->slug,$parent->id])}}">
            @csrf
        </form>
    </td>
</tr>

