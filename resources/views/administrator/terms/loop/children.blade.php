<tr> 
    <td>&nbsp;&nbsp; — {{$children->name}}</td>  
    <td>
       <a href="{{route('administrator.terms.edit',[$taxonomy->slug,$children->id])}}">Edit</a> | 
        <a href="{{route('administrator.terms.delete',[$taxonomy->slug,$children->id])}}" class="delete-data">Delete</a>
        <form class="d-none" method="post" action="{{route('administrator.terms.delete',[$taxonomy->slug,$children->id])}}">
            @csrf
        </form>
    </td>
</tr>