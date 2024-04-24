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
 * @property string $nom
 * @property string|null $prenom
 * @property string|null $email
 * @property string|null $telephone
 * @property string|null $antecedents
 * @property string|null $donnees_biographiques
 * @property string|null $histoire_maladie
 * @property string|null $entretiens
 * @property string|null $diagnostic
 * @property string|null $traitement
 * @property string|null $evolution
 * @property string|null $imagerie
 * @property string|null $bilan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InvoicePayment> $invoices
 * @property-read int|null $invoices_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RendezVous> $rendezVous
 * @property-read int|null $rendez_vous_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Report> $reports
 * @property-read int|null $reports_count
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAntecedents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereBilan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDiagnostic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDonneesBiographiques($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEntretiens($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEvolution($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereHistoireMaladie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereImagerie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTraitement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $client_id
 * @property string $nom_document
 * @property string $chemin_document
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDocument whereCheminDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDocument whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDocument whereNomDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientDocument whereUpdatedAt($value)
 */
	class ClientDocument extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\Client|null $client
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePayment query()
 */
	class InvoicePayment extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\Client|null $client
 * @method static \Illuminate\Database\Eloquent\Builder|RendezVous newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RendezVous newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RendezVous query()
 */
	class RendezVous extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $client_id
 * @property string $type
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @method static \Illuminate\Database\Eloquent\Builder|Report newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Report newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Report query()
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereUpdatedAt($value)
 */
	class Report extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $rendez_vous_id
 * @property string $heure_arrivee
 * @property string|null $heure_controle
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RendezVous|null $rendezvous
 * @method static \Illuminate\Database\Eloquent\Builder|SalleAttente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalleAttente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalleAttente query()
 * @method static \Illuminate\Database\Eloquent\Builder|SalleAttente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalleAttente whereHeureArrivee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalleAttente whereHeureControle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalleAttente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalleAttente whereRendezVousId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalleAttente whereUpdatedAt($value)
 */
	class SalleAttente extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

