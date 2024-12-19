<?php

use App\Models\Voyage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('etapes', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('resume');
            $table->text('description');
            $table->date("debut");
            $table->date("fin");
            $table->string('image')->nullable(); // Nouveau champ pour les images
            $table->foreignIdFor(Voyage::class)->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps(); // Ajout des timestamps pour created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etapes');
    }
};
