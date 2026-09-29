<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Documents - SNAA | Mairie de Banikoara</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <style>
        body {
            background: #f6f8fb;
            font-family: 'Nunito', sans-serif;
        }

        /* ==============================
           HEADER
        ============================== */

        .documents-header {
            background: linear-gradient(135deg, #006e50, #008f68);
            padding: 55px 0 75px;
            position: relative;
            overflow: hidden;
        }

        .documents-header::before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .06);
            top: -220px;
            right: -100px;
        }

        .documents-header::after {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .05);
            bottom: -170px;
            left: -100px;
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .back-btn {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, .15);
            color: white;
            text-decoration: none;
            transition: .25s ease;
        }

        .back-btn:hover {
            background: white;
            color: #006e50;
            transform: translateX(-3px);
        }

        .logo {
            height: 58px;
            width: auto;
        }

        .page-title {
            color: white;
            font-size: 42px;
            font-weight: 800;
            margin-top: 35px;
            margin-bottom: 10px;
        }

        .page-subtitle {
            color: rgba(255, 255, 255, .85);
            font-size: 17px;
            margin-bottom: 0;
        }

        /* ==============================
           SEARCH
        ============================== */

        .search-wrapper {
            position: relative;
            margin-top: -35px;
            z-index: 10;
        }

        .search-card {
            background: white;
            border: 0;
            border-radius: 18px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, .10);
            padding: 10px;
        }

        .search-inner {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #7b8794;
            font-size: 21px;
            z-index: 3;
        }

        .search-input {
            height: 62px;
            border: 0;
            background: #f6f8fb;
            border-radius: 13px;
            padding-left: 55px;
            padding-right: 55px;
            font-size: 16px;
            box-shadow: none !important;
        }

        .search-input:focus {
            background: #f1f4f7;
            border: 0;
        }

        .search-clear {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #7b8794;
            font-size: 19px;
            display: none;
        }

        /* ==============================
           DOCUMENTS
        ============================== */

        .documents-section {
            padding: 55px 0 80px;
        }

        .section-title {
            font-size: 25px;
            font-weight: 800;
            color: #25313c;
            margin-bottom: 5px;
        }

        .section-description {
            color: #7b8794;
            margin-bottom: 35px;
        }

        .document-card {
            height: 100%;
            background: white;
            border: 1px solid #edf0f3;
            border-radius: 18px;
            overflow: hidden;
            transition: all .3s ease;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .035);
        }

        .document-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 35px rgba(0, 0, 0, .10);
            border-color: rgba(0, 110, 80, .15);
        }

        .document-preview {
            height: 210px;
            background: #f3f5f7;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .document-preview::before {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(0, 110, 80, .04);
        }

        .pdf-image {
            width: 125px;
            height: 155px;
            object-fit: contain;
            position: relative;
            z-index: 2;
            transition: transform .3s ease;
        }

        .document-card:hover .pdf-image {
            transform: scale(1.06);
        }

        .pdf-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #dc3545;
            color: white;
            font-size: 11px;
            font-weight: 800;
            padding: 5px 9px;
            border-radius: 6px;
            z-index: 3;
        }

        .document-body {
            padding: 22px;
        }

        .document-name {
            color: #26323d;
            font-size: 17px;
            font-weight: 800;
            line-height: 1.4;
            margin-bottom: 10px;

            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 48px;
        }

        .document-size {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #89939e;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .document-actions {
            display: flex;
            gap: 10px;
        }

        .document-actions .btn {
            flex: 1;
            border-radius: 9px;
            padding: 10px 12px;
            font-weight: 700;
            font-size: 13px;
        }

        .btn-view {
            background: #006e50;
            border-color: #006e50;
            color: white;
        }

        .btn-view:hover {
            background: #00583f;
            border-color: #00583f;
            color: white;
        }

        .btn-download {
            background: #f0f3f5;
            border-color: #f0f3f5;
            color: #34404b;
        }

        .btn-download:hover {
            background: #e4e8eb;
            border-color: #e4e8eb;
            color: #006e50;
        }

        /* ==============================
           EMPTY STATE
        ============================== */

        .empty-state {
            background: white;
            border-radius: 18px;
            padding: 70px 30px;
            text-align: center;
            border: 1px solid #edf0f3;
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #f0f3f5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #89939e;
            font-size: 32px;
        }

        .empty-state h4 {
            font-weight: 800;
            color: #34404b;
        }

        .empty-state p {
            color: #89939e;
            margin-bottom: 0;
        }

        /* ==============================
           RESPONSIVE
        ============================== */

        @media (max-width: 767px) {

            .documents-header {
                padding: 35px 0 65px;
            }

            .page-title {
                font-size: 30px;
            }

            .page-subtitle {
                font-size: 15px;
            }

            .logo {
                height: 48px;
            }

            .documents-section {
                padding-top: 40px;
            }

            .document-preview {
                height: 190px;
            }
        }
    </style>
</head>

<body>

    {{-- ==============================
         HEADER
    ============================== --}}
    <header class="documents-header">

        <div class="container header-content">

            <div class="d-flex align-items-center justify-content-between">

                <a href="{{ url()->previous() }}" class="back-btn">
                    <i class="bi bi-chevron-left"></i>
                </a>

                <img
                    src="{{ asset('assets/images/logo/logo1.png') }}"
                    alt="Mairie de Banikoara"
                    class="logo"
                >

            </div>

            <div class="text-center">

                <h1 class="page-title">
                    Documents administratifs
                </h1>

                <p class="page-subtitle">
                    Recherchez, consultez et téléchargez les documents numérisés.
                </p>

            </div>

        </div>

    </header>


    {{-- ==============================
         SEARCH
    ============================== --}}
    <section class="search-wrapper">

        <div class="container">

            <div class="search-card">
                <form action="{{ route('documents.search') }}" method="GET">
                    <div class="search-inner">

                        <i class="bi bi-search search-icon"></i>

                        <input
                            type="text"
                            name="keyword"
                            id="documentSearch"
                            class="form-control search-input"
                            placeholder="Rechercher un document par son nom..."
                            value="{{ request('keyword') }}"
                            autocomplete="off"
                        >

                        <button
                            type="button"
                            id="clearSearch"
                            class="search-clear"
                        >
                            <i class="bi bi-x-circle"></i>
                        </button>

                    </div>
                </form>

            </div>

        </div>

    </section>


    {{-- ==============================
         DOCUMENTS
    ============================== --}}
    <main class="documents-section">

        <div class="container">

            <div class="mb-4">

                <h2 class="section-title">
                    Documents disponibles
                </h2>

                <p class="section-description">
                    Consultez les documents administratifs numérisés de la Mairie de Banikoara.
                </p>

            </div>


            @if ($documents->count() > 0)

                <div class="row g-4" id="documentsList">

                    @foreach ($documents as $file)

                        <div
                            class="col-lg-6 col-md-6 document-item"
                            data-document-name="{{ strtolower($file->titre) }}"
                        >

                            <div class="document-card">

                                {{-- Aperçu PDF --}}
                                <div class="document-preview">

                                    <span class="pdf-badge">
                                        PDF
                                    </span>

                                    <img
                                        src="{{ asset('assets/images/image_pdf.png') }}"
                                        alt="Document PDF"
                                        class="pdf-image"
                                    >

                                </div>


                                {{-- Informations --}}
                                <div class="document-body">

                                    <h3 class="document-name">
                                        {{ $file->name }}
                                    </h3>

                                    <div class="document-size">

                                        <i class="bi bi-file-earmark-pdf"></i>

                                        <span>
                                            {{ $file->size }} Ko
                                        </span>

                                    </div>


                                    {{-- Actions --}}
                                    <div class="document-actions">

                                        <a
                                            href="{{ route('read.file', $file->id) }}"
                                            target="_blank"
                                            class="btn btn-view"
                                        >
                                            <i class="bi bi-eye me-1"></i>
                                            Visualiser
                                        </a>

                                        <a
                                            href="{{ route('download.file', $file->id) }}"
                                            class="btn btn-download"
                                        >
                                            <i class="bi bi-download me-1"></i>
                                            Télécharger
                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>


                {{-- Aucun résultat de recherche --}}
                <div
                    id="noSearchResult"
                    class="empty-state mt-4"
                    style="display: none;"
                >

                    <div class="empty-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <h4>
                        Aucun document trouvé
                    </h4>

                    <p>
                        Aucun document ne correspond à votre recherche.
                    </p>

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        <i class="bi bi-folder-x"></i>
                    </div>

                    <h4>
                        Aucun document disponible
                    </h4>

                    <p>
                        Aucun document administratif n'est actuellement disponible.
                    </p>

                </div>

            @endif

        </div>

    </main>


    {{-- ==============================
         RECHERCHE VISUELLE
         Fonctionnalité provisoire
    ============================== --}}
    <script>
        const searchInput = document.getElementById('documentSearch');
        const clearSearch = document.getElementById('clearSearch');
        const documentItems = document.querySelectorAll('.document-item');
        const noSearchResult = document.getElementById('noSearchResult');

        if (searchInput) {

            searchInput.addEventListener('input', function () {

                const search = this.value.toLowerCase().trim();

                let visibleDocuments = 0;

                documentItems.forEach(function (item) {

                    const name = item.dataset.documentName || '';

                    if (name.includes(search)) {
                        item.style.display = '';
                        visibleDocuments++;
                    } else {
                        item.style.display = 'none';
                    }

                });

                if (clearSearch) {
                    clearSearch.style.display = search.length > 0
                        ? 'block'
                        : 'none';
                }

                if (noSearchResult) {
                    noSearchResult.style.display =
                        visibleDocuments === 0 && search.length > 0
                            ? 'block'
                            : 'none';
                }

            });

        }

        if (clearSearch) {

            clearSearch.addEventListener('click', function () {

                searchInput.value = '';

                documentItems.forEach(function (item) {
                    item.style.display = '';
                });

                clearSearch.style.display = 'none';

                if (noSearchResult) {
                    noSearchResult.style.display = 'none';
                }

                searchInput.focus();

            });

        }
    </script>

</body>

</html>

