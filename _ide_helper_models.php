<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $code
 * @property string $name
 * @property string|null $libre
 * @property int $level
 * @property int $status
 * @property string $username
 * @property string|null $details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdministrativeUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdministrativeUnit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdministrativeUnit query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdministrativeUnit whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdministrativeUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdministrativeUnit whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdministrativeUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdministrativeUnit whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdministrativeUnit whereLibre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdministrativeUnit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdministrativeUnit whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdministrativeUnit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdministrativeUnit whereUsername($value)
 */
	class AdministrativeUnit extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $file_id
 * @property int $user_id
 * @property string|null $name
 * @property string|null $mime_type
 * @property string|null $extension
 * @property int|null $size
 * @property string $path
 * @property string|null $disk
 * @property string|null $libre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\File $file
 * @method static \Illuminate\Database\Eloquent\Builder|FileDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|FileDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileDetail whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileDetail whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileDetail whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileDetail whereLibre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileDetail whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileDetail whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileDetail wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileDetail whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileDetail whereUserId($value)
 */
	class FileDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $file_id
 * @property int $user_id
 * @property int $ttr_id
 * @property string|null $details
 * @property string $created_at
 * @property-read \App\Models\File $file
 * @method static \Illuminate\Database\Eloquent\Builder|FileHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|FileHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileHistory whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileHistory whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileHistory whereTtrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileHistory whereUserId($value)
 */
	class FileHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $country
 * @property string|null $postal_code
 * @property string|null $phone
 * @property string|null $email
 * @property string $type
 * @property int $status
 * @property string $username
 * @property string|null $details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters query()
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Headquarters whereUsername($value)
 */
	class Headquarters extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $headquarters_id
 * @property int $administrative_units_id
 * @property int $code
 * @property string $name
 * @property string|null $floor
 * @property string $level
 * @property int $status
 * @property string $username
 * @property string|null $details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Office newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Office newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Office query()
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereAdministrativeUnitsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereHeadquartersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereUsername($value)
 */
	class Office extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $type_ident
 * @property string $ident
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string|null $email_1
 * @property string|null $phone
 * @property string|null $phone_1
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $country
 * @property string|null $postal_code
 * @property string|null $date_birth
 * @property string|null $libre
 * @property string|null $libre_1
 * @property string $rol
 * @property int $status
 * @property string $auth
 * @property mixed $password
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\File> $files
 * @property-read int|null $files_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Office> $offices
 * @property-read int|null $offices_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAuth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDateBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIdent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLibre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLibre1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTypeIdent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|radicationMail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|radicationMail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|radicationMail query()
 * @method static \Illuminate\Database\Eloquent\Builder|radicationMail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|radicationMail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|radicationMail whereUpdatedAt($value)
 */
	class radicationMail extends \Eloquent {}
}

