<?php

use App\Models\Event\EventFormData;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //General
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('health_problems')->nullable();
            $table->string('dietary_restrictions')->nullable();
            $table->boolean('is_disadvantaged')->default(false);
            $table->boolean('has_card')->default(false);
            $table->boolean('form_received')->default(false); //received signed registration form
            $table->boolean('is_legal_representative')->default(false);

            $table->foreignId('address_id');
            $table->foreignId('correspondence_address_id')->nullable();
            $table->foreignId('patrol_id')->nullable();
            $table->foreignId('troop_id')->nullable();
            $table->foreignId('group_id')->nullable();
            $table->foreignId('legal_representative_id')->nullable();
            $table->foreignId('user_id')->unique()->nullable();
        });
        Schema::create('legal_representatives', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->unique();

            $table->foreignId('address_id');
            $table->foreignId('correspondence_address_id')->nullable();
        });
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('street');
            $table->string('city');
            $table->string('postcode');
        });
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        //Organization units
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->smallInteger('number');
            $table->string('name');
            $table->string('iban');

            $table->foreignId('leader_id');
        });
        Schema::create('troops', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->tinyInteger('number');
            $table->string('name');

            $table->foreignId('leader_id');
            $table->foreignId('group_id');
        });
        Schema::create('patrols', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');

            $table->foreignId('leader_id');
            $table->foreignId('troop_id');
        });

        //Registrations
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->year('year');
            $table->float('fee');
            $table->float('donate');
            $table->float('payed');
            $table->string('note');

            $table->foreignId('legal_representative_id')->nullable();
            $table->foreignId('legal_member_id')->nullable();
        });
        Schema::create('registration_forms', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->text('info');
            $table->boolean('has_donation');

            $table->foreignId('coordinator_member_id');
            $table->foreignId('group_id')->nullable();
            $table->foreignId('troop_id')->nullable();
        });

        //Events
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('responsible_member_id');
            $table->foreignId('created_by_member_id');
        });
        Schema::create('event_form_data', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title');
            $table->enum('data_type', EventFormData::$dataTypes);

            $table->foreignId('event_id');
        });
        Schema::create('event_responses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->json('json_response');

            $table->foreignId('event_id');
            $table->foreignId('member_id');
        });

        /**
         * Constraints
         */
        //General
        Schema::table('members', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('correspondence_address_id')->references('id')->on('addresses');
            $table->foreign('patrol_id')->references('id')->on('patrols');
            $table->foreign('troop_id')->references('id')->on('troops');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('legal_representatives', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('correspondence_address_id')->references('id')->on('addresses');
        });
        //Organization units
        Schema::table('groups', function (Blueprint $table) {
            $table->foreign('leader_id')->references('id')->on('members');
        });
        Schema::table('troops', function (Blueprint $table) {
            $table->foreign('leader_id')->references('id')->on('members');
            $table->foreign('group_id')->references('id')->on('groups');
        });
        Schema::table('patrols', function (Blueprint $table) {
            $table->foreign('leader_id')->references('id')->on('members');
            $table->foreign('troop_id')->references('id')->on('troops');
        });
        //Registrations
        Schema::table('registrations', function (Blueprint $table) {
            $table->foreign('legal_representative_id')->references('id')->on('legal_representatives');
            $table->foreign('legal_member_id')->references('id')->on('members');
        });
        Schema::create('members_registrations', function (Blueprint $table) {
            $table->foreignId('member_id')->constrained('members')->on('members')->cascadeOnDelete();
            $table->foreignId('registration_id')->constrained('registrations')->on('registrations')->cascadeOnDelete();
        });
        Schema::table('registration_forms', function (Blueprint $table) {
            $table->foreign('coordinator_member_id')->references('id')->on('members');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('troop_id')->references('id')->on('troops');
        });
        //Events
        Schema::table('events', function (Blueprint $table) {
            $table->foreign('responsible_member_id')->references('id')->on('members');
            $table->foreign('created_by_member_id')->references('id')->on('members');
        });
        Schema::table('event_form_data', function (Blueprint $table) {
            $table->foreign('event_id')->references('id')->on('events');
        });
        Schema::table('event_responses', function (Blueprint $table) {
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('member_id')->references('id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table){
            $table->dropConstrainedForeignId('address_id');
            $table->dropConstrainedForeignId('correspondence_address_id');
            $table->dropConstrainedForeignId('patrol_id');
            $table->dropConstrainedForeignId('troop_id');
            $table->dropConstrainedForeignId('group_id');
            $table->dropConstrainedForeignId('user_id');
        });
        Schema::table('legal_representatives', function (Blueprint $table){
            $table->dropConstrainedForeignId('address_id');
            $table->dropConstrainedForeignId('correspondence_address_id');
        });
        Schema::table('groups', function (Blueprint $table){
            $table->dropConstrainedForeignId('leader_id');
        });
        Schema::table('troops', function (Blueprint $table){
            $table->dropConstrainedForeignId('leader_id');
            $table->dropConstrainedForeignId('group_id');
        });
        Schema::table('patrols', function (Blueprint $table){
            $table->dropConstrainedForeignId('leader_id');
            $table->dropConstrainedForeignId('troop_id');
        });
        Schema::table('registrations', function (Blueprint $table){
            $table->dropConstrainedForeignId('legal_representative_id');
            $table->dropConstrainedForeignId('responsible_member_id');
        });
        Schema::table('registration_forms', function (Blueprint $table){
            $table->dropConstrainedForeignId('coordinator_member_id');
            $table->dropConstrainedForeignId('group_id');
            $table->dropConstrainedForeignId('troop_id');
        });
        Schema::table('events', function (Blueprint $table){
            $table->dropConstrainedForeignId('responsible_member_id');
            $table->dropConstrainedForeignId('created_by_member_id');
        });
        Schema::table('event_form_data', function (Blueprint $table){
            $table->dropConstrainedForeignId('event_id');
        });
        Schema::table('event_responses', function (Blueprint $table){
            $table->dropConstrainedForeignId('event_id');
            $table->dropConstrainedForeignId('member_id');
        });

        Schema::dropIfExists('members_registrations');

        Schema::dropIfExists('members');
        Schema::dropIfExists('legal_representatives');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('users');

        Schema::dropIfExists('groups');
        Schema::dropIfExists('troops');
        Schema::dropIfExists('patrols');

        Schema::dropIfExists('registrations');
        Schema::dropIfExists('registration_forms');

        Schema::dropIfExists('events');
        Schema::dropIfExists('event_form_data');
        Schema::dropIfExists('event_responses');
    }
};
