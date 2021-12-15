<?php
  
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
  
class CreateProductsTable extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
			$table->string("kode", 30)->nullable();
            $table->string("nama", 255)->nullable();
            $table->string("image", 255)->nullable();
            $table->integer("harga");
            $table->timestamps();
        });
    }
 

    public function down()
    {
        Schema::dropIfExists('products');
    }
}