<?php

use App\User;
use App\Section;
use App\Menu;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Crypt;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Truncamos las tablas principales
      Role::truncate();
      User::truncate();

      //Creamos los roles predeterminados
      $superadminRole = Role::create(['name' => 'SuperAdmin']);
           $adminRole = Role::create(['name' => 'Admin']);
        $operatorRole = Role::create(['name' => 'Operator']);
            $userRole = Role::create(['name' => 'UserRole']);
         $monitorRole = Role::create(['name' => 'Monitor']);
         $surveyedRole = Role::create(['name' => 'Surveyed']);


      //Creamos los permisos predeterminados
        //- Dashboard principal
        $viewdashboardpral= Permission::create(['name' => 'View dashboard pral']);
        //- Inventario
        $inventoryviewdethotel= Permission::create(['name' => 'View detailed for hotel']);
        $inventoryviewdethotel2= Permission::create(['name' => 'View detailed for hotel with cost']);
        $inventoryviewdethotel3= Permission::create(['name' => 'View detailed for proyect']);
        $inventoryviewdethotel4= Permission::create(['name' => 'View cover']);
        $inventoryviewdethotel5= Permission::create(['name' => 'View distribucion']);

        //- Equipos
        $equipmentview= Permission::create(['name' => 'View add equipment']);
        $equipmentviewadd= Permission::create(['name' => 'Create equipment']);

        $equipmentviewremoved= Permission::create(['name' => 'View removed equipment']);
        $equipmentremoved= Permission::create(['name' => 'Removed equipment']);

        $equipmentviewsearch= Permission::create(['name' => 'View search equipment']);

        $equipmentviewmove= Permission::create(['name' => 'View move equipment']);
        $equipmentmove= Permission::create(['name' => 'Move equipment']);

        $equipmentviewgroup= Permission::create(['name' => 'View equipment group']);
        $equipmentviewgroupadd= Permission::create(['name' => 'Add equipment group']);
        $equipmentviewgroupremoved= Permission::create(['name' => 'Removed equipment group']);

        //- Reportes
        $viewassignreport= Permission::create(['name' => 'View assign report']);
        $viewcreatassignreport= Permission::create(['name' => 'Create assign report']);
        $vieweditreport= Permission::create(['name' => 'Edit assign report']);
        $viewdeletereport= Permission::create(['name' => 'Delete assign report']);

        $viewgeneralreport= Permission::create(['name' => 'View general report']);
        $viewcreatgeneralreport= Permission::create(['name' => 'Create general report']);

        $viewindividualreport= Permission::create(['name' => 'View individual capture']);
        $viewcreatindividualreport= Permission::create(['name' => 'Create individual capture']);

        $viewviewgeneratereport= Permission::create(['name' => 'View individual general report']);
        $vieweditgeneratereport= Permission::create(['name' => 'Edit individual general report']);

        $viewconciergeapproval= Permission::create(['name' => 'View concierge approval']);
        $viewcreatconciergeapproval= Permission::create(['name' => 'Create concierge approval']);
        $viewdeletconciergeapproval= Permission::create(['name' => 'Delete concierge approval']);

        $viewadminapproval = Permission::create(['name' => 'View admin approval']);
        $viewacceptadminapproval = Permission::create(['name' => 'Option admin approval']);
        $viewnotificationadminapproval = Permission::create(['name' => 'Notification admin approval']);

        $viewreport = Permission::create(['name' => 'View report']);

        //Calificaciones
        $viewaddsurvey = Permission::create(['name' => 'View create survey']);
        $viewgeneratesurvey = Permission::create(['name' => 'Generate survey']);

        $viewcapturesurvey = Permission::create(['name' => 'View capture survey']);
        $viewcreatsurvey = Permission::create(['name' => 'Create survey']);

        $vieweditsurvey = Permission::create(['name' => 'View edit survey']);
        $vieweditsurvey = Permission::create(['name' => 'Edit survey']);

        $viewresultsurvey = Permission::create(['name' => 'View results survey']);

        $viewconfigsurvey = Permission::create(['name' => 'View survey configuration']);
        $viewconfigaddsurvey = Permission::create(['name' => 'Assign user survey']);
        $viewconfigremovedsurvey = Permission::create(['name' => 'Removed user survey']);

        $viewconfiggeneratekeysurvey = Permission::create(['name' => 'Generate key user survey']);
        $viewconfigsendkeysurvey = Permission::create(['name' => 'Send email user survey']);
        $viewconfigviewkeysurvey = Permission::create(['name' => 'View key user survey']);

        //- Herramientas
        $toolsviewdiagnostic1= Permission::create(['name' => 'View guest review']);
        $toolsviewdiagnostic2= Permission::create(['name' => 'View server review']);
        $toolsviewtest = Permission::create(['name' => 'View test zd']);

        //- Configuración
        $viewcreatuserconfiguration = Permission::create(['name' => 'Create user']);
        $viewedituserconfiguration = Permission::create(['name' => 'Edit user']);
        $viewdeleteuserconfiguration = Permission::create(['name' => 'Delete user']);
        $viewconfiguration = Permission::create(['name' => 'View Configuration']);
        $vieweditconfiguration = Permission::create(['name' => 'Edit Configuration']);


      //Creamos los usuarios super admin
        $super_admin_a0 = new User;
        $super_admin_a0->name='SuperAdmin';
        $super_admin_a0->email='desarrollo@sitwifi.com';
        $super_admin_a0->city='Cancún, México';
        $super_admin_a0->password= bcrypt('123456');
        $super_admin_a0->avatar= 'dist/img/user.jpg';
        $super_admin_a0->save();
        $super_admin_a0->assignRole($superadminRole);
        //Permisos para el super usuario
          //- Dashboard
            $super_admin_a0->givePermissionTo('View dashboard pral');
          //- Inventario
            $super_admin_a0->givePermissionTo('View detailed for hotel');
            $super_admin_a0->givePermissionTo('View detailed for hotel with cost');
            $super_admin_a0->givePermissionTo('View detailed for proyect');
            $super_admin_a0->givePermissionTo('View cover');
            $super_admin_a0->givePermissionTo('View distribucion');
          //- Equipos
            $super_admin_a0->givePermissionTo('View add equipment');
            $super_admin_a0->givePermissionTo('Create equipment');
            $super_admin_a0->givePermissionTo('View removed equipment');
            $super_admin_a0->givePermissionTo('Removed equipment');
            $super_admin_a0->givePermissionTo('View search equipment');
            $super_admin_a0->givePermissionTo('View move equipment');
            $super_admin_a0->givePermissionTo('Move equipment');
            $super_admin_a0->givePermissionTo('View equipment group');
            $super_admin_a0->givePermissionTo('Add equipment group');
            $super_admin_a0->givePermissionTo('Removed equipment group');
          //- Reportes
            $super_admin_a0->givePermissionTo('View assign report');
            $super_admin_a0->givePermissionTo('Create assign report');
            $super_admin_a0->givePermissionTo('Edit assign report');
            $super_admin_a0->givePermissionTo('Delete assign report');
            $super_admin_a0->givePermissionTo('View general report');
            $super_admin_a0->givePermissionTo('Create general report');
            $super_admin_a0->givePermissionTo('View individual capture');
            $super_admin_a0->givePermissionTo('Create individual capture');
            $super_admin_a0->givePermissionTo('View individual general report');
            $super_admin_a0->givePermissionTo('Edit individual general report');
            $super_admin_a0->givePermissionTo('View concierge approval');
            $super_admin_a0->givePermissionTo('Create concierge approval');
            $super_admin_a0->givePermissionTo('Delete concierge approval');
            $super_admin_a0->givePermissionTo('View admin approval');
            $super_admin_a0->givePermissionTo('Option admin approval');
            $super_admin_a0->givePermissionTo('Notification admin approval');
            $super_admin_a0->givePermissionTo('View report');
          //Calificaciones
            $super_admin_a0->givePermissionTo('View create survey');
            $super_admin_a0->givePermissionTo('Generate survey');
            $super_admin_a0->givePermissionTo('View capture survey');
            $super_admin_a0->givePermissionTo('Create survey');
            $super_admin_a0->givePermissionTo('View edit survey');
            $super_admin_a0->givePermissionTo('Edit survey');
            $super_admin_a0->givePermissionTo('View results survey');
            $super_admin_a0->givePermissionTo('View survey configuration');
            $super_admin_a0->givePermissionTo('Assign user survey');
            $super_admin_a0->givePermissionTo('Removed user survey');
            $super_admin_a0->givePermissionTo('Generate key user survey');
            $super_admin_a0->givePermissionTo('Send email user survey');
            $super_admin_a0->givePermissionTo('View key user survey');
          //- Herramientas
            $super_admin_a0->givePermissionTo('View guest review');
            $super_admin_a0->givePermissionTo('View server review');
            $super_admin_a0->givePermissionTo('View test zd');
          //- Configuración
            $super_admin_a0->givePermissionTo('Create user');
            $super_admin_a0->givePermissionTo('Edit user');
            $super_admin_a0->givePermissionTo('Delete user');
            $super_admin_a0->givePermissionTo('View Configuration');
            $super_admin_a0->givePermissionTo('Edit Configuration');


      //Creamos usuario 1
        $super_admin_a = new User;
        $super_admin_a->name='Alonso de Jesus Cauich Viana';
        $super_admin_a->email='acauich@sitwifi.com';
        $super_admin_a->city='Cancún, México';
        $super_admin_a->password= bcrypt('123456');
        $super_admin_a->avatar= 'dist/img/user.jpg';
        $super_admin_a->save();
        $super_admin_a->assignRole($superadminRole);
        //Permisos para el super usuario
          //- Dashboard
            $super_admin_a->givePermissionTo('View dashboard pral');
          //- Inventario
            $super_admin_a->givePermissionTo('View detailed for hotel');
            $super_admin_a->givePermissionTo('View detailed for hotel with cost');
            $super_admin_a->givePermissionTo('View detailed for proyect');
            $super_admin_a->givePermissionTo('View cover');
            $super_admin_a->givePermissionTo('View distribucion');
          //- Equipos
            $super_admin_a->givePermissionTo('View add equipment');
            $super_admin_a->givePermissionTo('Create equipment');
            $super_admin_a->givePermissionTo('View removed equipment');
            $super_admin_a->givePermissionTo('Removed equipment');
            $super_admin_a->givePermissionTo('View search equipment');
            $super_admin_a->givePermissionTo('View move equipment');
            $super_admin_a->givePermissionTo('Move equipment');
            $super_admin_a->givePermissionTo('View equipment group');
            $super_admin_a->givePermissionTo('Add equipment group');
            $super_admin_a->givePermissionTo('Removed equipment group');
          //- Reportes
            $super_admin_a->givePermissionTo('View assign report');
            $super_admin_a->givePermissionTo('Create assign report');
            $super_admin_a->givePermissionTo('Edit assign report');
            $super_admin_a->givePermissionTo('Delete assign report');
            $super_admin_a->givePermissionTo('View general report');
            $super_admin_a->givePermissionTo('Create general report');
            $super_admin_a->givePermissionTo('View individual capture');
            $super_admin_a->givePermissionTo('Create individual capture');
            $super_admin_a->givePermissionTo('View individual general report');
            $super_admin_a->givePermissionTo('Edit individual general report');
            $super_admin_a->givePermissionTo('View concierge approval');
            $super_admin_a->givePermissionTo('Create concierge approval');
            $super_admin_a->givePermissionTo('Delete concierge approval');
            $super_admin_a->givePermissionTo('View admin approval');
            $super_admin_a->givePermissionTo('Option admin approval');
            $super_admin_a->givePermissionTo('Notification admin approval');
            $super_admin_a->givePermissionTo('View report');
          //Calificaciones
            $super_admin_a->givePermissionTo('View create survey');
            $super_admin_a->givePermissionTo('Generate survey');
            $super_admin_a->givePermissionTo('View capture survey');
            $super_admin_a->givePermissionTo('Create survey');
            $super_admin_a->givePermissionTo('View edit survey');
            $super_admin_a->givePermissionTo('Edit survey');
            $super_admin_a->givePermissionTo('View results survey');
            $super_admin_a->givePermissionTo('View survey configuration');
            $super_admin_a->givePermissionTo('Assign user survey');
            $super_admin_a->givePermissionTo('Removed user survey');
            $super_admin_a->givePermissionTo('Generate key user survey');
            $super_admin_a->givePermissionTo('Send email user survey');
            $super_admin_a->givePermissionTo('View key user survey');
          //- Herramientas
            $super_admin_a->givePermissionTo('View guest review');
            $super_admin_a->givePermissionTo('View server review');
            $super_admin_a->givePermissionTo('View test zd');
          //- Configuración
            $super_admin_a->givePermissionTo('Create user');
            $super_admin_a->givePermissionTo('Edit user');
            $super_admin_a->givePermissionTo('Delete user');
            $super_admin_a->givePermissionTo('View Configuration');
            $super_admin_a->givePermissionTo('Edit Configuration');
          //Actualizar la sell
            $user_shell=User::where('id', '=', $super_admin_a->id)->first();
            $user_shell->shell = Crypt::encrypt($super_admin_a->id);
            $user_shell->save();

      //Creamos usuario 2
        $super_admin_b = new User;
        $super_admin_b->name='Jose Antonio Esquinca Bonilla';
        $super_admin_b->email='jesquinca@sitwifi.com';
        $super_admin_b->city='Cancún, México';
        $super_admin_b->password= bcrypt('123456');
        $super_admin_b->avatar= 'dist/img/user.jpg';
        $super_admin_b->save();
        $super_admin_b->assignRole($superadminRole);
        //Permisos para el super usuario
          //- Dashboard
          $super_admin_b->givePermissionTo('View dashboard pral');
          //- Inventario
          $super_admin_b->givePermissionTo('View detailed for hotel');
          $super_admin_b->givePermissionTo('View detailed for hotel with cost');
          $super_admin_b->givePermissionTo('View detailed for proyect');
          $super_admin_b->givePermissionTo('View cover');
          $super_admin_b->givePermissionTo('View distribucion');
          //- Equipos
          $super_admin_b->givePermissionTo('View add equipment');
          $super_admin_b->givePermissionTo('Create equipment');
          $super_admin_b->givePermissionTo('View removed equipment');
          $super_admin_b->givePermissionTo('Removed equipment');
          $super_admin_b->givePermissionTo('View search equipment');
          $super_admin_b->givePermissionTo('View move equipment');
          $super_admin_b->givePermissionTo('Move equipment');
          $super_admin_b->givePermissionTo('View equipment group');
          $super_admin_b->givePermissionTo('Add equipment group');
          $super_admin_b->givePermissionTo('Removed equipment group');
          //- Reportes
          $super_admin_b->givePermissionTo('View assign report');
          $super_admin_b->givePermissionTo('Create assign report');
          $super_admin_b->givePermissionTo('Edit assign report');
          $super_admin_b->givePermissionTo('Delete assign report');
          $super_admin_b->givePermissionTo('View general report');
          $super_admin_b->givePermissionTo('Create general report');
          $super_admin_b->givePermissionTo('View individual capture');
          $super_admin_b->givePermissionTo('Create individual capture');
          $super_admin_b->givePermissionTo('View individual general report');
          $super_admin_b->givePermissionTo('Edit individual general report');
          $super_admin_b->givePermissionTo('View concierge approval');
          $super_admin_b->givePermissionTo('Create concierge approval');
          $super_admin_b->givePermissionTo('Delete concierge approval');
          $super_admin_b->givePermissionTo('View admin approval');
          $super_admin_b->givePermissionTo('Option admin approval');
          $super_admin_b->givePermissionTo('Notification admin approval');
          $super_admin_b->givePermissionTo('View report');
          //Calificaciones
          $super_admin_b->givePermissionTo('View create survey');
          $super_admin_b->givePermissionTo('Generate survey');
          $super_admin_b->givePermissionTo('View capture survey');
          $super_admin_b->givePermissionTo('Create survey');
          $super_admin_b->givePermissionTo('View edit survey');
          $super_admin_b->givePermissionTo('Edit survey');
          $super_admin_b->givePermissionTo('View results survey');
          $super_admin_b->givePermissionTo('View survey configuration');
          $super_admin_b->givePermissionTo('Assign user survey');
          $super_admin_b->givePermissionTo('Removed user survey');
          $super_admin_b->givePermissionTo('Generate key user survey');
          $super_admin_b->givePermissionTo('Send email user survey');
          $super_admin_b->givePermissionTo('View key user survey');
          //- Herramientas
          $super_admin_b->givePermissionTo('View guest review');
          $super_admin_b->givePermissionTo('View server review');
          $super_admin_b->givePermissionTo('View test zd');
          //- Configuración
          $super_admin_b->givePermissionTo('Create user');
          $super_admin_b->givePermissionTo('Edit user');
          $super_admin_b->givePermissionTo('Delete user');
          $super_admin_b->givePermissionTo('View Configuration');
          $super_admin_b->givePermissionTo('Edit Configuration');

      //Creamos usuario 3
        $super_admin_c = new User;
        $super_admin_c->name='Angel Gabriel Ramirez Ruiz';
        $super_admin_c->email='gramirez@sitwifi.com';
        $super_admin_c->city='Cancún, México';
        $super_admin_c->password= bcrypt('123456');
        $super_admin_c->avatar= 'dist/img/user.jpg';
        $super_admin_c->save();
        $super_admin_c->assignRole($superadminRole);
        //Permisos para el super usuario
          //- Dashboard
          $super_admin_c->givePermissionTo('View dashboard pral');
          //- Inventario
          $super_admin_c->givePermissionTo('View detailed for hotel');
          $super_admin_c->givePermissionTo('View detailed for hotel with cost');
          $super_admin_c->givePermissionTo('View detailed for proyect');
          $super_admin_c->givePermissionTo('View cover');
          $super_admin_c->givePermissionTo('View distribucion');
          //- Equipos
          $super_admin_c->givePermissionTo('View add equipment');
          $super_admin_c->givePermissionTo('Create equipment');
          $super_admin_c->givePermissionTo('View removed equipment');
          $super_admin_c->givePermissionTo('Removed equipment');
          $super_admin_c->givePermissionTo('View search equipment');
          $super_admin_c->givePermissionTo('View move equipment');
          $super_admin_c->givePermissionTo('Move equipment');
          $super_admin_c->givePermissionTo('View equipment group');
          $super_admin_c->givePermissionTo('Add equipment group');
          $super_admin_c->givePermissionTo('Removed equipment group');
          //- Reportes
          $super_admin_c->givePermissionTo('View assign report');
          $super_admin_c->givePermissionTo('Create assign report');
          $super_admin_c->givePermissionTo('Edit assign report');
          $super_admin_c->givePermissionTo('Delete assign report');
          $super_admin_c->givePermissionTo('View general report');
          $super_admin_c->givePermissionTo('Create general report');
          $super_admin_c->givePermissionTo('View individual capture');
          $super_admin_c->givePermissionTo('Create individual capture');
          $super_admin_c->givePermissionTo('View individual general report');
          $super_admin_c->givePermissionTo('Edit individual general report');
          $super_admin_c->givePermissionTo('View concierge approval');
          $super_admin_c->givePermissionTo('Create concierge approval');
          $super_admin_c->givePermissionTo('Delete concierge approval');
          $super_admin_c->givePermissionTo('View admin approval');
          $super_admin_c->givePermissionTo('Option admin approval');
          $super_admin_c->givePermissionTo('Notification admin approval');
          $super_admin_c->givePermissionTo('View report');
          //Calificaciones
          $super_admin_c->givePermissionTo('View create survey');
          $super_admin_c->givePermissionTo('Generate survey');
          $super_admin_c->givePermissionTo('View capture survey');
          $super_admin_c->givePermissionTo('Create survey');
          $super_admin_c->givePermissionTo('View edit survey');
          $super_admin_c->givePermissionTo('Edit survey');
          $super_admin_c->givePermissionTo('View results survey');
          $super_admin_c->givePermissionTo('View survey configuration');
          $super_admin_c->givePermissionTo('Assign user survey');
          $super_admin_c->givePermissionTo('Removed user survey');
          $super_admin_c->givePermissionTo('Generate key user survey');
          $super_admin_c->givePermissionTo('Send email user survey');
          $super_admin_c->givePermissionTo('View key user survey');
          //- Herramientas
          $super_admin_c->givePermissionTo('View guest review');
          $super_admin_c->givePermissionTo('View server review');
          $super_admin_c->givePermissionTo('View test zd');
          //- Configuración
          $super_admin_c->givePermissionTo('Create user');
          $super_admin_c->givePermissionTo('Edit user');
          $super_admin_c->givePermissionTo('Delete user');
          $super_admin_c->givePermissionTo('View Configuration');
          $super_admin_c->givePermissionTo('Edit Configuration');

      //Creamos los usuarios por default
        $user_default_a = new User;
        $user_default_a->name='Default Admin User';
        $user_default_a->email='admin@sitwifi.com';
        $user_default_a->city='Cancún, México';
        $user_default_a->password= bcrypt('123456');
        $user_default_a->avatar= 'dist/img/user.jpg';
        $user_default_a->save();
        $user_default_a->assignRole($adminRole);
        //
        $user_default_b = new User;
        $user_default_b->name='Default Operator User';
        $user_default_b->email='operator@sitwifi.com';
        $user_default_b->city='Cancún, México';
        $user_default_b->password= bcrypt('123456');
        $user_default_b->avatar= 'dist/img/user.jpg';
        $user_default_b->save();
        $user_default_b->assignRole($operatorRole);
        //
        $user_default_c = new User;
        $user_default_c->name='Default User';
        $user_default_c->email='user@sitwifi.com';
        $user_default_c->city='Cancún, México';
        $user_default_c->password= bcrypt('123456');
        $user_default_c->avatar= 'dist/img/user.jpg';
        $user_default_c->save();
        $user_default_c->assignRole($userRole);
        //
        $user_default_d = new User;
        $user_default_d->name='Default Monitor User';
        $user_default_d->email='monitor@sitwifi.com';
        $user_default_d->password= bcrypt('123456');
        $user_default_d->save();
        $user_default_d->assignRole($monitorRole);

      //Creamos las categorias de los menus
        $seccion_admin_a = new Section;
        $seccion_admin_a->name='inventory';
        $seccion_admin_a->display_name='Inventario';
        $seccion_admin_a->icons='fa fa-archive';
        $seccion_admin_a->save();

        $seccion_admin_b = new Section;
        $seccion_admin_b->name='report';
        $seccion_admin_b->display_name='Reportes';
        $seccion_admin_b->icons='fa fa-check-square-o';
        $seccion_admin_b->save();

        $seccion_admin_c = new Section;
        $seccion_admin_c->name='qualification';
        $seccion_admin_c->display_name='Calificación';
        $seccion_admin_c->icons='fa fa-calendar-plus-o';
        $seccion_admin_c->save();

        $seccion_admin_d = new Section;
        $seccion_admin_d->name='equipment';
        $seccion_admin_d->display_name='Equipos';
        $seccion_admin_d->icons='fa fa-briefcase';
        $seccion_admin_d->save();

        $seccion_admin_e = new Section;
        $seccion_admin_e->name='tools';
        $seccion_admin_e->display_name='Herramientas';
        $seccion_admin_e->icons='fa fa-wrench';
        $seccion_admin_e->save();

      //Menu Inventario
        $menuAdminA0 = new Menu;
        $menuAdminA0->name='detailed_hotel';
        $menuAdminA0->display_name='Detallado por Hotel';
        $menuAdminA0->description='Permite visualizar el inventario actual de los sitios permitidos.';
        $menuAdminA0->url='detailed_hotel';
        $menuAdminA0->section_id=$seccion_admin_a->id;
        $menuAdminA0->icons='fa fa-circle-o';
        $menuAdminA0->save();
        $assigned_menu_a0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminA0->id]);
        $assigned_menu_a1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminA0->id]);
        $assigned_menu_a2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminA0->id]);
        $assigned_menu_a3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminA0->id]);

        $menuAdminA1 = new Menu;
        $menuAdminA1->name='detailed_hotels';
        $menuAdminA1->display_name='Detallado por Hotel con precios';
        $menuAdminA1->description='Permite visualizar el inventario actual de los sitios con precios permitidos.';
        $menuAdminA1->url='detailed_hotels';
        $menuAdminA1->section_id=$seccion_admin_a->id;
        $menuAdminA1->icons='fa fa-circle-o';
        $menuAdminA1->save();
        $assigned_menu_b0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminA1->id]);
        $assigned_menu_b1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminA1->id]);
        $assigned_menu_b2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminA1->id]);
        $assigned_menu_b3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminA1->id]);

        $menuAdminA2 = new Menu;
        $menuAdminA2->name='detailed_proyect';
        $menuAdminA2->display_name='Detallado por proyecto';
        $menuAdminA2->description='Permite visualizar el inventario actual en base a los proyectos.';
        $menuAdminA2->url='detailed_proyect';
        $menuAdminA2->section_id=$seccion_admin_a->id;
        $menuAdminA2->icons='fa fa-circle-o';
        $menuAdminA2->save();
        $assigned_menu_c0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminA2->id]);
        $assigned_menu_c1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminA2->id]);
        $assigned_menu_c2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminA2->id]);
        $assigned_menu_c3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminA2->id]);

        $menuAdminA3 = new Menu;
        $menuAdminA3->name='detailed_cover';
        $menuAdminA3->display_name='Carta de entrega';
        $menuAdminA3->description='Permite visualizar la carta de entrega.';
        $menuAdminA3->url='detailed_cover';
        $menuAdminA3->section_id=$seccion_admin_a->id;
        $menuAdminA3->icons='fa fa-circle-o';
        $menuAdminA3->save();
        $assigned_menu_d0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminA3->id]);
        $assigned_menu_d1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminA3->id]);
        $assigned_menu_d2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminA3->id]);
        $assigned_menu_d3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminA3->id]);

        $menuAdminA4 = new Menu;
        $menuAdminA4->name='detailed_distribution';
        $menuAdminA4->display_name='Distribucion';
        $menuAdminA4->description='Permite visualizar la distribución actual.';
        $menuAdminA4->url='detailed_distribution';
        $menuAdminA4->section_id=$seccion_admin_a->id;
        $menuAdminA4->icons='fa fa-circle-o';
        $menuAdminA4->save();
        $assigned_menu_e0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminA4->id]);
        $assigned_menu_e1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminA4->id]);
        $assigned_menu_e2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminA4->id]);
        $assigned_menu_e3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminA4->id]);

      //Menu Equipos

        $menuAdminB0 = new Menu;
        $menuAdminB0->name='up_equipment';
        $menuAdminB0->display_name='Altas';
        $menuAdminB0->description='Permite dar de altas nuevos equipos';
        $menuAdminB0->url='up_equipment';
        $menuAdminB0->section_id=$seccion_admin_d->id;
        $menuAdminB0->icons='fa fa-chevron-circle-up';
        $menuAdminB0->save();
        $assigned_menu_one_a0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminB0->id]);
        $assigned_menu_one_a1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminB0->id]);
        $assigned_menu_one_a2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminB0->id]);
        $assigned_menu_one_a3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminB0->id]);

        $menuAdminB1 = new Menu;
        $menuAdminB1->name='down_equipment';
        $menuAdminB1->display_name='Bajas';
        $menuAdminB1->description='Permite dar de baja equipos';
        $menuAdminB1->url='down_equipment';
        $menuAdminB1->section_id=$seccion_admin_d->id;
        $menuAdminB1->icons='fa fa-chevron-circle-down';
        $menuAdminB1->save();
        $assigned_menu_one_b0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminB1->id]);
        $assigned_menu_one_b1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminB1->id]);
        $assigned_menu_one_b2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminB1->id]);
        $assigned_menu_one_b3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminB1->id]);

        $menuAdminB2 = new Menu;
        $menuAdminB2->name='detailed_search';
        $menuAdminB2->display_name='Buscador';
        $menuAdminB2->description='Permite visualizar el buscador de equipos';
        $menuAdminB2->url='detailed_search';
        $menuAdminB2->section_id=$seccion_admin_d->id;
        $menuAdminB2->icons='fa fa-search';
        $menuAdminB2->save();
        $assigned_menu_one_c0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminB2->id]);
        $assigned_menu_one_c1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminB2->id]);
        $assigned_menu_one_c2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminB2->id]);
        $assigned_menu_one_c3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminB2->id]);

        $menuAdminB3 = new Menu;
        $menuAdminB3->name='move_equipment';
        $menuAdminB3->display_name='Movimientos';
        $menuAdminB3->description='Permite mover equipos';
        $menuAdminB3->url='move_equipment';
        $menuAdminB3->section_id=$seccion_admin_d->id;
        $menuAdminB3->icons='fa fa-arrows';
        $menuAdminB3->save();
        $assigned_menu_one_d0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminB3->id]);
        $assigned_menu_one_d1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminB3->id]);
        $assigned_menu_one_d2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminB3->id]);
        $assigned_menu_one_d3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminB3->id]);

        $menuAdminB4 = new Menu;
        $menuAdminB4->name='group_equipment';
        $menuAdminB4->display_name='Grupos';
        $menuAdminB4->description='Permite agrupar equipos';
        $menuAdminB4->url='group_equipment';
        $menuAdminB4->section_id=$seccion_admin_d->id;
        $menuAdminB4->icons='fa fa-object-group';
        $menuAdminB4->save();
        $assigned_menu_one_e0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminB4->id]);
        $assigned_menu_one_e1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminB4->id]);
        $assigned_menu_one_e2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminB4->id]);
        $assigned_menu_one_e3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminB4->id]);


      //Menu Reportes
        $menuAdminC0 = new Menu;
        $menuAdminC0->name='type_report';
        $menuAdminC0->display_name='Asignación de reporte';
        $menuAdminC0->description='Permite manipular y establecer los valor predeterminados para cada hotel.';
        $menuAdminC0->url='type_report';
        $menuAdminC0->section_id=$seccion_admin_b->id;
        $menuAdminC0->icons='fa fa-square-o';
        $menuAdminC0->save();

        $assigned_menu_two_a0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminC0->id]);
        $assigned_menu_two_a1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminC0->id]);
        $assigned_menu_two_a2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminC0->id]);
        $assigned_menu_two_a3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminC0->id]);

        $menuAdminC1 = new Menu;
        $menuAdminC1->name='generate';
        $menuAdminC1->display_name='Generar Reporte';
        $menuAdminC1->description='Permite capturar de manera generar el reporte diario del hotel asignado.';
        $menuAdminC1->url='generate';
        $menuAdminC1->section_id=$seccion_admin_b->id;
        $menuAdminC1->icons='fa fa-square-o';
        $menuAdminC1->save();

        $assigned_menu_two_b0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminC1->id]);
        $assigned_menu_two_b1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminC1->id]);
        $assigned_menu_two_b2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminC1->id]);
        $assigned_menu_two_b3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminC1->id]);

        $menuAdminC2 = new Menu;
        $menuAdminC2->name='individual';
        $menuAdminC2->display_name='Captura Individual';
        $menuAdminC2->description='Permite realizar la captura individual de cada hotel asignado.';
        $menuAdminC2->url='individual';
        $menuAdminC2->section_id=$seccion_admin_b->id;
        $menuAdminC2->icons='fa fa-square-o';
        $menuAdminC2->save();

        $assigned_menu_two_c0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminC2->id]);
        $assigned_menu_two_c1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminC2->id]);
        $assigned_menu_two_c2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminC2->id]);
        $assigned_menu_two_c3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminC2->id]);

        $menuAdminC3 = new Menu;
        $menuAdminC3->name='edit_report';
        $menuAdminC3->display_name='Editar Reportes';
        $menuAdminC3->description='Permite editar el reporte capturado de cada hotel asignado.';
        $menuAdminC3->url='edit_report';
        $menuAdminC3->section_id=$seccion_admin_b->id;
        $menuAdminC3->icons='fa fa-square-o';
        $menuAdminC3->save();

        $assigned_menu_two_d0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminC3->id]);
        $assigned_menu_two_d1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminC3->id]);
        $assigned_menu_two_d2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminC3->id]);
        $assigned_menu_two_d3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminC3->id]);


        $menuAdminC4 = new Menu;
        $menuAdminC4->name='approval';
        $menuAdminC4->display_name='Aprobación Concierge';
        $menuAdminC4->description='Permite realizar la aprobación de concierge.';
        $menuAdminC4->url='approval';
        $menuAdminC4->section_id=$seccion_admin_b->id;
        $menuAdminC4->icons='fa fa-square-o';
        $menuAdminC4->save();

        $assigned_menu_two_e0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminC4->id]);
        $assigned_menu_two_e1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminC4->id]);
        $assigned_menu_two_e2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminC4->id]);
        $assigned_menu_two_e3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminC4->id]);

        $menuAdminC5 = new Menu;
        $menuAdminC5->name='approvals';
        $menuAdminC5->display_name='Aprobación Admin';
        $menuAdminC5->description='Permite verificar y aprobar reportes.';
        $menuAdminC5->url='approvals';
        $menuAdminC5->section_id=$seccion_admin_b->id;
        $menuAdminC5->icons='fa fa-square-o';
        $menuAdminC5->save();

        $assigned_menu_two_f0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminC5->id]);
        $assigned_menu_two_f1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminC5->id]);
        $assigned_menu_two_f2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminC5->id]);
        $assigned_menu_two_f3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminC5->id]);

        $menuAdminC6 = new Menu;
        $menuAdminC6->name='viewreports';
        $menuAdminC6->display_name='Ver Reportes';
        $menuAdminC6->description='Permite visualizar los reportes de cada hotel.';
        $menuAdminC6->url='viewreports';
        $menuAdminC6->section_id=$seccion_admin_b->id;
        $menuAdminC6->icons='fa fa-square-o';
        $menuAdminC6->save();

        $assigned_menu_two_g0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminC6->id]);
        $assigned_menu_two_g1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminC6->id]);
        $assigned_menu_two_g2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminC6->id]);
        $assigned_menu_two_g3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminC6->id]);

      //Menu Calificaciones
        $menuAdminD0 = new Menu;
        $menuAdminD0->name='create_survey_admin';
        $menuAdminD0->display_name='Crear encuesta';
        $menuAdminD0->description='Permite crear la encuesta mensual.';
        $menuAdminD0->url='create_survey_admin';
        $menuAdminD0->section_id=$seccion_admin_c->id;
        $menuAdminD0->icons='fa fa-plus-square-o';
        $menuAdminD0->save();
        $assigned_menu_three_a0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminD0->id]);
        $assigned_menu_three_a1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminD0->id]);
        $assigned_menu_three_a2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminD0->id]);
        $assigned_menu_three_a3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminD0->id]);

        $menuAdminD1 = new Menu;
        $menuAdminD1->name='fill_survey_admin';
        $menuAdminD1->display_name='Llenar encuesta';
        $menuAdminD1->description='Permite capturar la encuesta mensual de un hotel de manera manual.';
        $menuAdminD1->url='fill_survey_admin';
        $menuAdminD1->section_id=$seccion_admin_c->id;
        $menuAdminD1->icons='fa fa-indent';
        $menuAdminD1->save();
        $assigned_menu_three_b0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminD1->id]);
        $assigned_menu_three_b1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminD1->id]);
        $assigned_menu_three_b2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminD1->id]);
        $assigned_menu_three_b3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminD1->id]);

        $menuAdminD2 = new Menu;
        $menuAdminD2->name='edit_survey_admin';
        $menuAdminD2->display_name='Editar encuesta';
        $menuAdminD2->description='Permite editar una encuesta mensual capturada por un miembro de un hotel.';
        $menuAdminD2->url='edit_survey_admin';
        $menuAdminD2->section_id=$seccion_admin_c->id;
        $menuAdminD2->icons='fa fa-inbox';
        $menuAdminD2->save();
        $assigned_menu_three_c0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminD2->id]);
        $assigned_menu_three_c1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminD2->id]);
        $assigned_menu_three_c2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminD2->id]);
        $assigned_menu_three_c3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminD2->id]);

        $menuAdminD3 = new Menu;
        $menuAdminD3->name='survey_results';
        $menuAdminD3->display_name='Resultados encuesta';
        $menuAdminD3->description='Permite visualizar las calificaciones de cada sitio.';
        $menuAdminD3->url='survey_results';
        $menuAdminD3->section_id=$seccion_admin_c->id;
        $menuAdminD3->icons='fa fa-info-circle';
        $menuAdminD3->save();
        $assigned_menu_three_d0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminD3->id]);
        $assigned_menu_three_d1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminD3->id]);
        $assigned_menu_three_d2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminD3->id]);
        $assigned_menu_three_d3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminD3->id]);

        $menuAdminD4 = new Menu;
        $menuAdminD4->name='configure_survey_admin';
        $menuAdminD4->display_name='Configuración encuesta';
        $menuAdminD4->description='Permite configurar las encuestas de cada sitio.';
        $menuAdminD4->url='configure_survey_admin';
        $menuAdminD4->section_id=$seccion_admin_c->id;
        $menuAdminD4->icons='fa fa-cog';
        $menuAdminD4->save();
        $assigned_menu_three_e0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminD4->id]);
        $assigned_menu_three_e1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminD4->id]);
        $assigned_menu_three_e2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminD4->id]);
        $assigned_menu_three_e3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminD4->id]);

      //Menu Herramientas
        $menuAdminE0 = new Menu;
        $menuAdminE0->name='detailed_guest_review';
        $menuAdminE0->display_name='Diagnósticos huéspedes';
        $menuAdminE0->description='Permite visualizar el diagnósticos huéspedes';
        $menuAdminE0->url='detailed_guest_review';
        $menuAdminE0->section_id=$seccion_admin_e->id;
        $menuAdminE0->icons='fa fa-tag';
        $menuAdminE0->save();
        $assigned_menu_four_a0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminE0->id]);
        $assigned_menu_four_a1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminE0->id]);
        $assigned_menu_four_a2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminE0->id]);
        $assigned_menu_four_a3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminE0->id]);

        $menuAdminE1 = new Menu;
        $menuAdminE1->name='detailed_server_review';
        $menuAdminE1->display_name='Diagnósticos servidores';
        $menuAdminE1->description='Permite visualizar el diagnósticos servidores';
        $menuAdminE1->url='detailed_server_review';
        $menuAdminE1->section_id=$seccion_admin_e->id;
        $menuAdminE1->icons='fa fa-tag';
        $menuAdminE1->save();
        $assigned_menu_four_b0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminE1->id]);
        $assigned_menu_four_b1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminE1->id]);
        $assigned_menu_four_b2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminE1->id]);
        $assigned_menu_four_b3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminE1->id]);

        $menuAdminE2 = new Menu;
        $menuAdminE2->name='testzone';
        $menuAdminE2->display_name='Testeo ZD';
        $menuAdminE2->description='Permite realizar los testeos de direcciónes ip con puertos.';
        $menuAdminE2->url='testzone';
        $menuAdminE2->section_id=$seccion_admin_e->id;
        $menuAdminE2->icons='fa fa-tag';
        $menuAdminE2->save();
        $assigned_menu_two_c0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminE2->id]);
        $assigned_menu_two_c1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminE2->id]);
        $assigned_menu_two_c2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminE2->id]);
        $assigned_menu_two_c3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminE2->id]);
    }
}
