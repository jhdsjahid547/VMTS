@foreach($notifications as $notification)
    <div class="col-md-12 mb-2">
        <a href="{{ route('subscriber.markasread', $notification->id) }}">
            <div class="card h-100 border-2 {{ empty($notification->read_at) ? 'border-danger bg-secondary-light-4' : 'border-lime' }}">
                <div class="card-header">
                    <p class="text-secondary"><b>{{ isset($notification->data['author']) ? ucfirst($notification->data['author']) : 'System' }}</b> notify you.</p>
                </div>
                <div class="card-body py-2">
                    <p class="text-black">{{ $notification->data['data'] }}</p>
                    @if(isset($notification->data['path']))
                        <a class="badge badge-soft-dark" target="_blank" href="{{ Storage::url($notification->data['path']) }}"><i class="fa fa-paperclip"></i>Attachment</a>
                    @endif
                    <p class="text-muted"><small>{{ $notification->created_at->diffForHumans() }}</small></p>
                </div>
            </div>
        </a>
    </div>
@endforeach
