/**
 * @Script js for (Template/Project Name)
 *
 * @project     - Project Name
 * @author      -
 * @created_by  -
 * @created_at  -
 * @modified_by -
 */

$(function () {

    var ballotLength;
    var totalBallot;
    // window.API_URL = 'https://evote.apiprojects.link';
    // window.API_URL = $('.result').data('api-url');
    window.API_URL = document.head.querySelector('meta[name="base-url"]').content;

    /**
     * @method { get totalRequest }
     *
     * @type  {}
     * @param  {e}
     * @return  {}
     */
    (
        function () {
            $.ajax({
                url: API_URL + '/api/get-total-request',
                type: 'get',
                success: function (data) {
                    if (data) {
                        totalBallot = data?.data;
                        ballotLength = totalBallot.length;
                    }
                },
                error: function (exception) {
                    console.log(exception);
                },
            });
        }
    )();

    /**
     * @method { get companyDetails }
     *
     * @type  {}
     * @param  {}
     * @return  {}
     */
    (
        function () {
            $.ajax({
                url: API_URL + '/api/company-details',
                type: 'get',
                success: function (data) {
                    if (data) {
                        const {address, organization, icon} = data?.data;
                        const markup = `
                            <div class="d-lg-flex align-items-center gap-4 justify-content-center text-center ballots-head mb-4">
                                <div class="f">
                                    <div class="club-details text-lg-start d-inline-block">
                                        <h5 class="fs-5 fw-normal mb-1">${organization}</h5>
                                        <p class="mb-0"><small>${address}</small></p>
                                    </div>
                                </div>
                                <div class="f">
                                    <img src="${icon !== undefined ? icon : 'logo.png'}" alt="logo" class="img-fluid d-inline-block"
                                        style="max-height:60px ;" />
                                </div>
                            </div> `;
                        $('#ballots-widget').before(markup);
                    }
                },
                error: function (exception) {
                    if (exception) {
                        console.error('Cannot get company details !!');
                    }
                },
            });
        }
    )();

    /**
     * @method { makeMarkupForBallotsWidget }
     *
     * @type  {}
     * @param  {e}
     * @return  {}
     */
    if ($('#result-scanning').length) {
        function makeMarkupForBallotsWidget(ballots) {
            let markup = '';
            ballots.forEach((ballot, key) => {
                const {positionName, positionId, candidates, voteLimited} = ballot;
                markup += `
                    <div data-position-id="${positionId}" class="ballots-widget mb-4">
                        <h3 class="fs-6 fw-normal pb-2 b border-bottom mb-4">
                            Select Any (${voteLimited}) For
                            <strong>${positionName}</strong>
                        </h3>
                        <div class="eVote-table table-responsive">
                            <table class="table align-middle table-primary table-striped">
                                <thead>
                                    <tr>
                                        <th>S/L</th>
                                        <th>${positionName} Candidate</th>
                                        <th>Image</th>
                                        <th class="text-center">Vote</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${candidates
                    .map((candidate, i) => {
                        return `
                                                <tr data-candidate-id="${candidate?.candidateId}">
                                                    <td> ${i + 1} </td>
                                                    <td> ${candidate?.name} </td>
                                                    <td>
                                                        ${
                            candidate.icon !== null && candidate.icon !== undefined
                                ? `<img src='${candidate?.icon}'  alt="Icon" className="img-fluid candidate-img" />`
                                : 'No Image'
                        }
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-check d-inline-flex form-check-md">
                                                            <input class="form-check-input" readonly="" disabled=""
                                                                type="radio">
                                                        </div>
                                                    </td>
                                                </tr>
                                            `;
                    })
                    .join('')}
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;
            });
            return markup;
        }

        function makeMarkupForCandidatesResult(allBallots) {
            let markup = '';
            allBallots.forEach((ballot, key) => {
                const {positionName, positionId, candidates, voteLimited} = ballot;
                markup += ` <div class="ballots-widget mb-4">
                         <h3 class="fs-6 fw-normal pb-2 b border-bottom mb-4">
                            Vote Count for <strong>${positionName}</strong>
                        </h3>
                    <div class="eVote-table table-responsive">
                        <table class="table align-middle table-success">
                            <thead>
                                <tr>

                                    <th>Candidate Name </th>
                                    <th>Image</th>
                                    <th class="text-center">Vote</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${candidates
                    .map((candidate) => {
                        return `
                                        <tr data-candidate-id="${candidate?.candidateId}" data-total-vote="0">

                                            <td> ${candidate?.name} </td>
                                            <td>
                                                ${
                            candidate.icon !== null && candidate.icon !== undefined
                                ? `<img src='${candidate?.icon}' alt="Icon" className="img-fluid candidate-img" />`
                                : 'No Image'
                        }
                                            </td>
                                            <td class="text-center total-vote">0</td>
                                        </tr>
                                        `;
                    })
                    .join('')}
                            </tbody>
                        </table>
                    </div>
                </div>
                `
            })
            return markup
        }

        (function () {
            $.ajax({
                url: API_URL + '/api/get-all-ballots',
                type: 'get',
                beforeSend: function () {
                    $('.is-loading').removeClass('d-none');
                },
                success: function (response) {
                    const responseData = response?.data;
                    const allBallots =
                        Array.isArray(responseData) &&
                        responseData.reduce((accumulator, ballot) => {
                            const {
                                position_id,
                                vote_limit,
                                ballot_items,
                                position: {name: position_name},
                            } = ballot;
                            let candidates = ballot_items.map((candidate) => {
                                const {
                                    candidate: {name: candidate_name, icon},
                                    candidate_id,
                                } = candidate;
                                return {
                                    name: candidate_name,
                                    candidateId: candidate_id,
                                    icon: icon,
                                };
                            });
                            accumulator.push({
                                positionName: position_name,
                                positionId: position_id,
                                candidates: candidates,
                                voteLimited: vote_limit,
                            });

                            return accumulator;
                        }, []);
                    const allCandidates = allBallots.map((ballot) => ballot.candidates).reduce((prev, current) => [...prev, ...current]);

                    $('#ballots-widget').append(makeMarkupForBallotsWidget(allBallots));
                    $('#candidates-result').append(makeMarkupForCandidatesResult(allBallots));
                },
                complete: function () {
                    $('.is-loading').addClass('d-none');
                },
                error: function (exception) {
                    if (exception) {
                        console.error('Cannot get all ballots paper !!');
                    }
                },
            });
        })();
    }

    /**
     * @method { getVotes }
     *
     * @type  {}
     * @param  {e}
     * @return  {}
     */

    if ($('#btn-scanning-result').length) {
        $('#btn-scanning-result').on('click', function (e) {
            // reset
            $('#ballots-widget').find('.form-check-input').prop('checked', false);
            $('.result tr').removeClass('table-success');
            $('.result .total-vote').text('0');
            $('.result tr').attr('data-total-vote', '0');

            var idx = 0;
            const getVotes = (id) => {
                $.ajax({
                    url: API_URL + `/api/get-vote/${id}`,
                    type: 'get',
                    success: function (data) {
                        if (data) {
                            const candidates = data?.data?.candidate_ids;
                            const delay = 1200;
                            let isLoading = false;
                            let loadingCountableText = 3;
                            for (let i = 0; i < candidates.length; i++) {
                                setTimeout(function timer() {
                                    isLoading = true;
                                    dataCandidateId = candidates[i];


                                    let ballotWidgetTr = document.querySelectorAll(`[data-candidate-id="${dataCandidateId}"]`);
                                    $('#ballots-widget').find('.form-check-input').prop('checked', false);
                                    $('.result tr').removeClass('table-success');

                                    if ($(ballotWidgetTr).find('.form-check-input').prop('checked', true).end().addClass('table-success')) {
                                        $('.current-ballot').text(id);
                                        let currentText = parseInt($(ballotWidgetTr).find('.total-vote').text(), 10) + 1;
                                        $(ballotWidgetTr).find('.total-vote').text(currentText).end().addClass('table-success');
                                        $(ballotWidgetTr).attr('data-total-vote', currentText);

                                        // $('#candidates-result tbody').html(
                                        //     $('#candidates-result tbody tr').sort(function (a, b) {
                                        //         return $(b).data('total-vote') > $(a).data('total-vote') ? 1 : -1;
                                        //     })
                                        // );
                                    }

                                    if (isLoading) {
                                        $('#btn-scanning-result')
                                            .find('.bi')
                                            .toggleClass('bi bi-align-start spinner-border spinner-border-sm')
                                            .end()
                                            .find('.text')
                                            .text(`Next Counting... ${loadingCountableText}`)
                                            .end()
                                            .toggleClass('disabled');
                                        loadingCountableText -= 1;
                                    }

                                    if (i == candidates.length - 1) {
                                        setTimeout(function () {
                                            idx += 1;
                                            if (idx < ballotLength) {
                                                getVotes(totalBallot[idx]);
                                            } else {
                                                $('#ballots-widget').find('.form-check-input').prop('checked', false);
                                                $('#btn-scanning-result')
                                                    .find('.spinner-border')
                                                    .toggleClass('bi bi-align-start spinner-border spinner-border-sm')
                                                    .end()
                                                    .find('.text')
                                                    .text('Start')
                                                    .end()
                                                    .toggleClass('disabled');
                                                $('.result tr').removeClass('table-success');
                                                $('.current-ballot').text('');
                                                isLoading = false;
                                            }
                                        }, delay);
                                    }
                                }, i * delay);
                            }
                        }
                    },
                    error: function (exception) {
                        if (exception) {
                            console.error('Can not get vote for specific id !!');
                        }
                    },
                });
            };
            if (ballotLength !== undefined && ballotLength > 0) {
                getVotes(totalBallot[0]);
            } else {
                console.error('Please set , how many times will continue request for getting voting result !!');
            }
        });
    }
})
