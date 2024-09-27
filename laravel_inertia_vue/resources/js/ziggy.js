const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"dashboard":{"uri":"dashboard","methods":["GET","HEAD"]},"settings":{"uri":"settings","methods":["GET","HEAD"]},"settings_email.update":{"uri":"settings","methods":["PATCH"]},"profile.destroy":{"uri":"settings","methods":["DELETE"]},"home":{"uri":"\/","methods":["GET","HEAD"]},"user.destroy":{"uri":"home\/{user}","methods":["DELETE"],"parameters":["user"],"bindings":{"user":"id"}},"user.edit":{"uri":"home\/{user}\/edit","methods":["GET","HEAD"],"parameters":["user"],"bindings":{"user":"id"}},"user.update":{"uri":"home\/users\/{user}","methods":["PATCH"],"parameters":["user"],"bindings":{"user":"id"}},"logout":{"uri":"logout","methods":["POST"]},"register":{"uri":"register","methods":["GET","HEAD"]},"login":{"uri":"login","methods":["GET","HEAD"]},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"]},"password.email":{"uri":"forgot-password","methods":["POST"]},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"],"parameters":["token"]},"password.update":{"uri":"reset-password","methods":["POST"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
