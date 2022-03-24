<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            CourseResource::collection(Course::all()),
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $data = $request->all();
        $course = Course::create($data);
        return response()->json(CourseResource::make($course), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(
            CourseResource::make(Course::find($id)),
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, Course $course)
    {
        $data = $request->only([
            'title',
            'description',
            'author',
            'url'
        ]);

        $course->title = $data['title'];
        $course->description = $data['description'];
        $course->author = $data['author'];
        $course->url = $data['url'] ?? null;
        $course->save();

        return response()->json(
            CourseResource::make($course),
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //$course = Course::findOrFail($id);

        $course->delete();

        //Course::destroy($id);
        return response()->json(
            null,
            Response::HTTP_NO_CONTENT
        );
    }
}
