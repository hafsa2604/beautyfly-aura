@extends('admin.layouts.app')

@section('title', 'Contact Message Details')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Contact Message Details</h4>
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-light btn-sm">Back to List</a>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">ID:</dt>
                        <dd class="col-sm-9">{{ $contact->id }}</dd>

                        <dt class="col-sm-3">Name:</dt>
                        <dd class="col-sm-9"><strong>{{ $contact->name }}</strong></dd>

                        <dt class="col-sm-3">Email:</dt>
                        <dd class="col-sm-9"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></dd>

                        <dt class="col-sm-3">Status:</dt>
                        <dd class="col-sm-9">
                            <span class="badge 
                                @if($contact->status == 'new') bg-primary
                                @elseif($contact->status == 'read') bg-info
                                @else bg-success
                                @endif">
                                {{ ucfirst($contact->status) }}
                            </span>
                        </dd>

                        <dt class="col-sm-3">Date:</dt>
                        <dd class="col-sm-9">{{ $contact->created_at->format('M d, Y H:i') }}</dd>

                        <dt class="col-sm-3">Message:</dt>
                        <dd class="col-sm-9">
                            <div class="border p-3 rounded bg-light">
                                {{ $contact->message }}
                            </div>
                        </dd>
                    </dl>

                    <hr>

                    <div class="mt-4">
                        <h5>Update Status</h5>
                        <form action="{{ route('admin.contacts.update', $contact) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="status" class="form-select" required>
                                        <option value="new" {{ $contact->status == 'new' ? 'selected' : '' }}>New</option>
                                        <option value="read" {{ $contact->status == 'read' ? 'selected' : '' }}>Read</option>
                                        <option value="replied" {{ $contact->status == 'replied' ? 'selected' : '' }}>Replied</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Update Status</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

