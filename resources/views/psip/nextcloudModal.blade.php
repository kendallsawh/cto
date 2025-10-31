<div class="modal fade" id="nextcloudmodal" tabindex="-1" aria-labelledby="nextcloudmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-xl modal-fullscreen-md-down"> <!-- Responsive classes added here -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="nextcloudmodalLabel">Visit our Nextcloud hub for more features</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="d-flex flex-column flex-md-row justify-content-between align-items-start">
                    <p>Hey, do you know that all files uploaded to this page can also be accessed at
                        <strong>
                            <a href="https://cloud.malf.gov.tt/index.php/apps/tables/#/view/142" target="_blank" class="text-decoration-dull-blue" style="text-decoration: none">
                                MALF's Nextcloud Hub
                            </a>?
                        </strong>
                        <br>
                        It's the perfect solution when you need to access your documents in a secure and convenient way anywhere and anytime.
                    </p>

                </ul>
                <h6>An exmple of how your data is organized on the Nextcloud Hub:</h6>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Division</th>
                            <th scope="col">PSIP</th>
                            <th scope="col">Activities</th>
                            <th scope="col">Folder Link</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td class="text-decoration-dull-blue">Your Division is listed here</td>
                            <td class="text-decoration-dull-blue">The PSIP for your Division</td>
                            <td class="text-decoration-dull-blue">This column shows the activities associated with the PSIP.
                                Please note the <strong>"Folder:"</strong> suffix. The <strong>numerical value</strong> after the suffix is the name of the folder where all the documents for that specific activity are stored.</td>
                            <td class="text-decoration-dull-blue">Link to the files and folders that was uploaded in this web app.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ Auth::user()->division()->division_name }}
                            </td>
                            <td>Z999</td>
                            <td>Activity Name 1 - <strong>Folder: 1</strong><br>
                                Activity Name 2 - <strong>Folder: 2</strong><br>
                                Activity Name 3 - <strong>Folder: 5</strong><br>
                            </td>
                            <td><a href="#">A0000</a></td>
                        </tr>
                        <tr>
                            <td>{{ Auth::user()->division()->division_name }}</td>
                            <td>X000</td>
                            <td>Activity Name 1 - <strong>Folder: 1</strong><br>
                            </td>
                            <td><a href="#">A0000</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
