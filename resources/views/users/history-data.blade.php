@foreach ($history as $item)
    <tr class="text-center">
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->subject_type }}</td>
        <td>{{ $item->location }}</td>
        <td>{{ $item->description ?? "No description available" }}</td>
        <td>{{ $item->created_at->format('d M Y, h:i A') }}</td>
        <td><a href="{{ route('user.view-info',[ 'id'=>$item->id]) }}" class="btn btn-primary btn-sm">View Details</a></td>
    </tr>
@endforeach

@if ($history->isEmpty())
    <tr><td colspan="6" class="text-center">No incidents found matching your criteria.</td></tr>
@endif
