<!DOCTYPE html>
<html>
<head>
	<title>VR</title>
</head>
<body>
	<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #f8fafc; margin: 0; padding: 0; width: 100%;">
		<tbody>
			<tr>
				<td align="center">
					<table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
						<tbody>
							<tr>
								<td class="header" style="padding: 25px 0; text-align: center;">
									<a target="_blank" rel="noopener noreferrer" href="{{url('/')}}" style="color: #bbbfc3; font-size: 19px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;">
										VR
									</a>
								</td>
							</tr>

							<tr>
								<td class="body" width="100%" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-bottom: 1px solid #edeff2; border-top: 1px solid #edeff2; margin: 0; padding: 0; width: 100%;">
									<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #ffffff; margin: 0 auto; padding: 0; width: 570px;">
										<tbody>

											<tr>
												<td class="content-cell" style="padding: 35px;">
													<h1 style="color: #3d4852; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">	Hello,
													</h1>

													<div style="color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">

													</div>


													<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style=" margin: 30px auto; padding: 0; text-align: center; width: 100%;">
														<tbody>
															<tr>
																<td align="center">
																	<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
																		<tbody>
																			<tr>
																				<td align="left">
																					Category
																				</td>
																				<td align="left">

																					 @isset($user->terms)
																	                 @if(!$user->terms->isEmpty())
																	                          <ul>
																	                          @foreach($user->terms as $term)
																	                          <li>{{$term->name}}</li>
																	                          @endforeach
																	                        </ul>
																	                      @endif
																	                  @endif
																				</td>
																			</tr>
																			<tr>
																				<td align="left">
																					Weight
																				</td>
																				<td align="left">
																					@isset($user->vendorProfile->points)
                   																		{{$user->vendorProfile->points}}
                																	@endif
																				</td>
																			</tr>
																			<tr>
																				<td align="left">
																					Company name
																				</td>
																				<td align="left">
																					@isset($user->vendorProfile->name)
																	                    <span>{{$user->vendorProfile->name}}</span>
																	                @endif
																				</td>
																			</tr>
																			<tr>
																				<td align="left">
																					Address
																				</td>
																				<td align="left">
																					@isset($user->vendorProfile->address)
																	                    <span>{{$user->vendorProfile->address}}</span>
																	                @endif
																				</td>
																			</tr>
																			<tr>
																				<td align="left">
																					Date of registration
																				</td>
																				<td align="left">
																					@isset($user->vendorProfile->date_of_registration)
																	                    <span>{{$user->vendorProfile->date_of_registration}}</span>
																	                @endif
																				</td>
																			</tr>
																			<tr>
																				<td align="left">
																					No of experienced years
																				</td>
																				<td align="left">
																					@isset($user->vendorProfile->no_of_experience_years)
																	                    <span>{{$user->vendorProfile->no_of_experience_years}}</span>
																	                @endif
																				</td>
																			</tr>
																			<tr>
																				<td align="left">
																					No of clients
																				</td>
																				<td align="left">
																					@isset($user->vendorProfile->no_of_clients)
																	                    <span>{{$user->vendorProfile->no_of_clients}}</span>
																	                @endif
																				</td>
																			</tr>
																			<tr>
																				<td align="left">
																					Registration no.
																				</td>
																				<td align="left">
																					@isset($user->vendorProfile->registration_no)
																	                    <span>{{$user->vendorProfile->registration_no}}</span>
																	                @endif
																				</td>
																			</tr>
																			<tr>
																				<td align="left">
																					PAN / VAT no
																				</td>
																				<td align="left">
																					@isset($user->vendorProfile->pan_or_vat_no)
																	                    <span>{{$user->vendorProfile->pan_or_vat_no}}</span>
																	                @endif
																				</td>
																			</tr>
																			<tr>
																				<td align="left">
																					Last year turnover
																				</td>
																				<td align="left">
																					@isset($user->vendorProfile->last_year_turnover)
																	                    <span>{{$user->vendorProfile->last_year_turnover}}</span>
																	                @endif
																				</td>
																			</tr>
																			<tr>
																				<td align="left">
																					Contact person name
																				</td>
																				<td align="left">
																					@isset($user->vendorContact->name)
																	                    <span>{{$user->vendorContact->name}}</span>
																	                @endif
																				</td>
																			</tr>
																			<tr>
																				<td align="left">
																					Contact person email
																				</td>
																				<td align="left">
																					@isset($user->vendorContact->email)
																	                    <span>{{$user->vendorContact->email}}</span>
																	                @endif
																				</td>
																			</tr>
																			<tr>
																				<td align="left">
																					Contact person mobile
																				</td>
																				<td align="left">
																					@isset($user->vendorContact->mobile)
																	                    <span>{{$user->vendorContact->mobile}}</span>
																	                @endif
																				</td>
																			</tr>
																			<tr>
																				<td align="left">
																					Office phone
																				</td>
																				<td align="left">
																					@isset($user->vendorContact->office_phone)
																	                    <span>{{$user->vendorContact->office_phone}}</span>
																	                @endif
																				</td>
																			</tr>
																			<tr>
																				<td align="left">
																					Office email
																				</td>
																				<td align="left">
																					@isset($user->vendorContact->mobile)
																	                    <span>{{$user->vendorContact->office_email}}</span>
																	                @endif
																				</td>
																			</tr>
																		</tbody>
																		</table>
																		</td>
																	</tr></tbody>
																</table>
																<p style=" color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">Regards,<br>
																VR</p>
															</td>
														</tr>
													</tbody></table>
												</td>
											</tr>
											<tr>
												<td>
													<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="margin: 0 auto; padding: 0; text-align: center; width: 570px; ">
														<tbody>
															<tr>
																<td class="content-cell" align="center" style="padding: 35px;">
																	<p style=" line-height: 1.5em; margin-top: 0; color: #aeaeae; font-size: 12px; text-align: center;">© 2020 VR. All rights reserved.</p>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</body>
				</html>