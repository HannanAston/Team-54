@section('title', 'About Us')

<x-app-layout>

    <!-- ===== HERO STORY BANNER ===== -->

    <section style="position:relative; height:80vh; overflow:hidden;">

        <img src="horse-lead-cropped.jpg" style="width:100%; height:100%; object-fit:cover; filter:brightness(0.7);">

        <div
            style="
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
        text-align:center;
        color:#f0f0f0;
        max-width:700px;
        padding:20px;
    ">

            <h1 style="font-size:56px; letter-spacing:4px; margin-bottom:20px;">
                OUR STORY
            </h1>

            <p style="font-size:20px; color:#ddd;">
                Reclaiming the past. Reimagining the future.
            </p>

        </div>
    </section>

    <!-- ===== MISSION ===== -->

    <section style="background:#f0f0f0; padding:80px 20px; color:#333;">

        <div
            style="max-width:1100px; margin:auto; display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:center;">

            <img src="close-up.jpg" style="width:100%; height:500px; object-fit:cover;">

            <div>
                <h2 style="letter-spacing:3px; margin-bottom:20px;">WHY WE EXIST</h2>

                <p style="color:#666; line-height:1.7;">
                    Revival Threads began with a simple belief: clothing shouldn’t have an expiry date.
                    Every garment carries a history — of craftsmanship, materials, and the lives lived in it.
                </p>

                <p style="color:#666; line-height:1.7;">
                    We rescue forgotten pieces, restore them with care, and return them to the world ready for a second
                    life.
                </p>
            </div>

        </div>
    </section>

    <!-- ===== PROCESS ===== -->

    <section style="background:#333; color:#f0f0f0; padding:80px 20px;">

        <div
            style="max-width:1100px; margin:auto; display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:center;">

            <div>
                <h2 style="letter-spacing:3px; margin-bottom:20px;">OUR PROCESS</h2>

                <p style="color:#ccc; line-height:1.7;">
                    Each piece is carefully inspected, repaired, cleaned, and restored.
                    We emphasise durability over fast fashion, craftsmanship over convenience.
                </p>

                <p style="color:#ccc; line-height:1.7;">
                    Nothing we sell is disposable.
                </p>
            </div>

            <img src="cowboy light.jpg" style="width:100%; height:500px; object-fit:cover;">

        </div>
    </section>

    <!-- ===== VALUES BANNER ===== -->

    <section style="position:relative; height:60vh; overflow:hidden;">

        <img src="mountain-logs-cropped.jpg" style="width:100%; height:100%; object-fit:cover; filter:brightness(0.6);">

        <div
            style="
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
        text-align:center;
        color:#f0f0f0;
        max-width:700px;
        padding:20px;
    ">

            <h2 style="font-size:42px; letter-spacing:3px; margin-bottom:20px;">
                FASHION WITHOUT WASTE
            </h2>

            <p style="color:#ddd;">
                Every garment built to last.
            </p>

        </div>
    </section>

    <!-- ===== TEAM / CTA ===== -->

    <section style="background:#f0f0f0; color:#333; padding:80px 20px; text-align:center;">

        <h2 style="letter-spacing:3px; margin-bottom:20px;">THE TEAM</h2>

        <p style="color:#666; margin-bottom:40px;">
            Abdul • Angad • Ahmiada • Adam • Aiden • Stef • Jibril
        </p>

        <a href="/products"
            style="
        background:#c19a6b;
        color:#fff;
        padding:14px 36px;
        text-decoration:none;
        font-weight:bold;
        letter-spacing:1px;
       ">
            SHOP THE COLLECTION
        </a>

    </section>


</x-app-layout>
