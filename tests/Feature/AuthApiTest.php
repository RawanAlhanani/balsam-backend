<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\LoginAdmin;
use App\Tuteur;
use Illuminate\Support\Facades\Hash;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_login_with_correct_credentials()
    {
        $admin = LoginAdmin::create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
            'role' => 'president'
        ]);

        $response = $this->postJson('/api/admin-login', [
            'login' => 'admin@test.com',
            'mdp' => 'password123'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['token', 'user', 'is_admin'])
                 ->assertJsonPath('user.role', 'president');
    }

    /** @test */
    public function an_admin_cannot_login_with_wrong_password()
    {
        $admin = LoginAdmin::create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
            'role' => 'president'
        ]);

        $response = $this->postJson('/api/admin-login', [
            'login' => 'admin@test.com',
            'mdp' => 'wrongpassword'
        ]);

        $response->assertStatus(401);
    }

    /** @test */
    public function a_volunteer_can_register_successfully()
    {
        $response = $this->postJson('/api/register', [
            'account_type' => 'volunteer',
            'nom_tuteur' => 'Doe',
            'prenom_tuteur' => 'John',
            'email_tuteur' => 'john@volunteer.com',
            'region_id' => 1,
            'nom_utilisateur' => 'johndoe',
            'mot_de_pass' => 'password123',
            'professional_field' => 'Student',
            'interests' => ['Awareness', 'Training']
        ]);

        $response->assertStatus(201)
                 ->assertJson(['message' => 'تم تسجيل المتطوع بنجاح']);

        $this->assertDatabaseHas('tuteurs', [
            'email_tuteur' => 'john@volunteer.com',
            'account_type' => 'volunteer'
        ]);
    }

    /** @test */
    public function a_beneficiary_family_can_register_successfully()
    {
        $response = $this->postJson('/api/register', [
            'account_type' => 'beneficiary',
            'nom_tuteur' => 'Smith',
            'prenom_tuteur' => 'Jane',
            'CIN' => 'AB123456',
            'adresse' => 'Street 123',
            'region_id' => 1,
            'email_tuteur' => 'jane@family.com',
            'telephon' => '0600000000',
            'whatsapp' => '0600000000',
            'nom_utilisateur' => 'janesmith',
            'mot_de_pass' => 'password123',
            'nom_enfant' => 'Kid',
            'prenom_enfant' => 'Junior',
            'date_naissance' => '2015-01-01',
            'sexeEnfant' => '2',
            'statut' => '1',
            'parole' => '1',
            'avs' => '2',
            'etude' => '1',
            'type_Tuteur' => '1',
            'formation' => '1'
        ]);

        $response->assertStatus(201)
                 ->assertJson(['message' => 'تم التسجيل بنجاح']);

        $this->assertDatabaseHas('tuteurs', [
            'email_tuteur' => 'jane@family.com',
            'account_type' => 'beneficiary'
        ]);
        
        $this->assertDatabaseHas('enfants', [
            'nom_enfant' => 'Kid'
        ]);
    }

    /** @test */
    public function a_non_president_admin_cannot_access_admin_accounts()
    {
        $admin = LoginAdmin::create([
            'name' => 'Secretary',
            'email' => 'sec@test.com',
            'password' => Hash::make('password123'),
            'role' => 'secretary'
        ]);

        $response = $this->actingAs($admin, 'admin')
                         ->getJson('/api/admin/accounts');

        $response->assertStatus(403)
                 ->assertJson(['message' => 'غير مسموح لك بالدخول. هذه الصلاحية خاصة بالرئيس فقط.']);
    }

    /** @test */
    public function a_president_can_access_admin_accounts()
    {
        $admin = LoginAdmin::create([
            'name' => 'President',
            'email' => 'pres@test.com',
            'password' => Hash::make('password123'),
            'role' => 'president'
        ]);

        $response = $this->actingAs($admin, 'admin')
                         ->getJson('/api/admin/accounts');

        $response->assertStatus(200);
    }
}
