<div class="accordion pb-4 vacancy-detail" id="accordionPanelsStayOpenExample">
    <div class="accordion-item rounded-0">
        <h2 class="accordion-header">
            <button class="accordion-button px-3 py-2 rounded-0" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">Kualifikasi</button>
        </h2>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
            <div class="accordion-body p-3">
                {!! Str::headline(htmlspecialchars_decode(stripslashes($vacancy->qualification))) !!}
            </div>
        </div>
    </div>
    <div class="accordion-item rounded-0">
        <h2 class="accordion-header">
            <button class="accordion-button px-3 py-2 rounded-0 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">Deksripsi</button>
        </h2>
        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
            <div class="accordion-body p-3">
                {!! Str::headline(htmlspecialchars_decode(stripslashes($vacancy->description))) !!}
            </div>
        </div>
    </div>
    <div class="accordion-item rounded-0">
        <h2 class="accordion-header">
            <button class="accordion-button px-3 py-2 rounded-0 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">Keahlian</button>
        </h2>
        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
            <div class="accordion-body p-3">
                @foreach ($vacancy->skills as $skill)
                <span class="badge text-bg-color">
                    <i class="bi bi-hash"></i>
                    {{ Str::slug($skill->name) }}
                </span>
                @endforeach
            </div>
        </div>
    </div>
</div>