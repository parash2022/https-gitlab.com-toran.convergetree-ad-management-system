<tr> 
    <td>{{$parent->id}}</td>
    <td>{{$parent->title}}</td>
    <td>{{$parent->status}}</td>  
    <td>
       <a href="{{route('administrator.pages.edit',[$parent->id])}}">Edit</a>
        <a href="{{route('administrator.pages.delete',[$parent->id])}}" class="delete-data">Delete</a>
        <form class="d-none" method="post" action="{{route('administrator.pages.delete',[$parent->id])}}">
            @csrf
        </form>
    </td>
</tr>

