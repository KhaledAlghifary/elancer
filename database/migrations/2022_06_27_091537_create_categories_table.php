<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            // $table->bigInteger('id')->unsigned()->autoIncrement()->primary();
            // $table->unsignedBigInteger('id')->autoIncrement()->primary();
            // $table->bigIncrements('id')->primary();
            $table->id();

            $table->string('name')->unique(); //name varchar(255) unique

            $table->string('slug')->unique(); //replace the id table by name **ex:catogeries/10, catogeries/web-devolopment

            //Description
            $table->text('description')->nullable();
             
            //show icons or images
            $table->string('art_path')->nullable();

            /*
            //catogeries - sub Catogeries

            $table->unsignedBigInteger('parent_id')->nullable(); 

            $table->foreign('parent_id')->references('id')->on('categories')
            ->nullOnDelete(); //to make it nullOnDelete must be nullable
            //->onDelete('set null'); //make a relation between the parent and id, like restrict(default),set null,cascade,no action
            */
            //to short the upper two lines
            $table->foreignId('parent_id')->nullable()->constrained('categories','id')->nullOnDelete();//constrained replace for 'refrences and on'

            $table->timestamps(); //creat two cloumns  1-created_at timestamp null 2-updated_at timestamp null 'information about records'

            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
