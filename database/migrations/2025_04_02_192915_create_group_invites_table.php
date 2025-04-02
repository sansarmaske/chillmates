<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Group;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('group_invites', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignIdFor(Group::class)
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->foreignIdFor(User::class, 'from_user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->foreignIdFor(User::class, 'to_user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_invites');
    }
};
