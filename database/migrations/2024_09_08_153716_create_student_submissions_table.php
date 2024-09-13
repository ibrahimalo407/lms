<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('student_submissions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_assignment_id')->constrained()->onDelete('cascade');
        $table->text('submission_text')->nullable();
        $table->string('submission_file')->nullable();
        $table->timestamp('submitted_at')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_submissions');
    }
}
