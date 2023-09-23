<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'country', 'name', 'salary_start', 'salary_end', 'salary_show', 'type', 'length', 'qualifications', 'description', 'about_company', 'roles', 'benefits', 'typical_day', 'working_days', 'working_hours', 'release_date', 'closing_date'
    ];

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeValid($query)
    {
        return $query->whereDate('release_date', '<=', now())->whereDate('closing_date', '>=', now())->latest();
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'salary' => 'float',
        'roles' => 'array',
        'release_date' => 'date',
        'closing_date' => 'date'
    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function getDayAttribute()
    {
        $days = explode('-', $this->days);
        return $days;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function getTimeAttribute()
    {
        $days = explode('-', $this->timing);
        return $days;
    }

    /**
     * Get the job applications for the job.
     */
    public function career_applicants()
    {
        return $this->hasMany(CareerApplicant::class);
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function getSalaryAttribute()
    {
        return $this->salary_start . '-' . $this->salary_end;
    }
}
