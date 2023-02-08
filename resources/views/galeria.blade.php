 <style>
      body {
        padding: 20px;
        font-family: sans-serif;
        background: #f2f2f2;
      }
      img {
        width: 100%; /* need to overwrite inline dimensions */
        height: auto;
      }
      h2 {
        margin-bottom: 0.5em;
      }
      .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        grid-gap: 1em;
      }

      /* hover styles */
      .location-listing {
        position: relative;
      }

      .location-image {
        line-height: 0;
        overflow: hidden;
      }

      .location-image img {
        filter: blur(0px);
        transition: filter 0.3s ease-in;
        transform: scale(1.1);
      }

      .location-title {
        font-size: 1.5em;
        font-weight: bold;
        text-decoration: none;
        z-index: 1;
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        transition: opacity 0.5s;
        background: rgba(90, 0, 10, 0.4);
        color: white;

        /* position the text in t’ middle*/
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .location-listing:hover .location-title {
        opacity: 1;
      }

      .location-listing:hover .location-image img {
        filter: blur(2px);
      }

      /* for touch screen devices */
      @media (hover: none) {
        .location-title {
          opacity: 1;
        }
        .location-image img {
          filter: blur(2px);
        }
      }
    </style>
<div class="child-page-listing">

      <div class="grid-container">
        <article id="3685" class="location-listing">
          <a class="location-title" href="#">
            Laura Flores, Ángela Carrasco, Alicia Villarreal, Dulce
          </a>
          <div class="location-image">
            <a href="#">
              <img
                width="300"
                height="169"
                src="https://entrefam.com/wp-content/uploads/2023/01/ENTREFAM48555029_-960x640.jpg"
                alt="Laura Flores, Ángela Carrasco, Alicia Villarreal, Dulce"
              />
            </a>
          </div>
        </article>

        <article id="3688" class="location-listing">
          <a class="location-title" href="#"> Danna Paola </a>

          <div class="location-image">
            <a href="#">
              <img
                width="300"
                height="169"
                src="https://entrefam.com/wp-content/uploads/2023/01/AMC48164990_-960x640.jpg"
                alt="Danna Paola"
              />
            </a>
          </div>
        </article>

        <article id="3691" class="location-listing">
          <a class="location-title" href="#">
            Coque Muñiz en Conferencia por su Presentación en el Lunario
          </a>

          <div class="location-image">
            <a href="#">
              <img
                width="300"
                height="169"
                src="https://entrefam.com/wp-content/uploads/2023/02/AMC54505624_-960x640.jpg"
                alt="Coque Muñiz en Conferencia por su Presentación en el Lunario"
              />
            </a>
          </div>
        </article>

        <article id="3694" class="location-listing">
          <a class="location-title" href="#">
            Manoella Torres se Presentará en el Lunario del Auditorio de la
            CDMX</a
          >

          <div class="location-image">
            <a href="#">
              <img
                style="height: 250px !important; width: auto !important"
                src="https://entrefam.com/wp-content/uploads/2023/02/AMC54385612_-960x1440.jpg"
                alt="Manoella Torres se Presentará en el Lunario del Auditorio de la CDMX"
              />
            </a>
          </div>
        </article>

        <article id="3697" class="location-listing">
          <a class="location-title" href="#">Celebridades en el Homenaje a Silvia Pinal, como La Mujer Del Siglo </a>

          <div class="location-image">
            <a href="#">
              <img
                style="height: 250px !important; width: auto !important"
                src="https://entrefam.com/wp-content/uploads/2023/02/ENTREFAM56195793_-960x1440.jpg"
                alt="Celebridades en el Homenaje a Silvia Pinal, como La Mujer Del Siglo"
              />
            </a>
          </div>
        </article>

        <article id="3700" class="location-listing">
          <a class="location-title" href="#">
            Raquel Rocha, Maribel Guardia, Alexis Núñez
          </a>

          <div class="location-image">
            <a href="#" style="text-align: end">
              <img
                width="300"
                height="169"
                src="https://entrefam.com/wp-content/uploads/2023/02/ENTREFAM51045278_-960x640.jpg"
                alt="Raquel Rocha, Maribel Guardia, Alexis Núñez"
              />
            </a>
          </div>
        </article>
        <article id="3700" class="location-listing">
          <a class="location-title" href="#">
            Jesse Huerta, Joy Huerta
          </a>

          <div class="location-image">
            <a href="#" style="text-align: end">
              <img
                width="300"
                height="169"
                src="https://entrefam.com/wp-content/uploads/2023/02/AMC54275601_-960x640.jpg"
                alt="Jesse Huerta, Joy Huerta"
              />
            </a>
          </div>
        </article>
        <article id="3700" class="location-listing">
          <a class="location-title" href="#">
            Elenco El Señor de los Cielos
          </a>

          <div class="location-image">
            <a href="#" style="text-align: end">
              <img
                width="300"
                height="169"
                src="https://entrefam.com/wp-content/uploads/2023/01/ENTREFAM18432017_-960x640.jpg"
                alt="Elenco El Señor de los Cielos"
              />
            </a>
          </div>
        </article>
      </div>
      <!-- end grid container -->
    </div>
