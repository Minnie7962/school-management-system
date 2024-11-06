@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="dashboard-wrapper">
    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Students</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalStudents }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Teachers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTeachers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Buses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBuses }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Recent Notices -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Notices</h6>
                </div>
                <div class="card-body">
                    @if($notices->count() > 0)
                        @foreach($notices as $notice)
                            <div class="notice-item mb-3">
                                <h6 class="font-weight-bold">{{ $notice->title }}</h6>
                                <p class="mb-1">{{ Str::limit($notice->content, 100) }}</p>
                                <small class="text-muted">Posted on {{ $notice->created_at->format('M d, Y') }}</small>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center">No notices available</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Students by Class -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Students by Class</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Class</th>
                                    <th>Number of Students</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($studentsByClass as $class)
                                    <tr>
                                        <td>{{ $class->class }}</td>
                                        <td>{{ $class->count }}</td>
                                    </tr>